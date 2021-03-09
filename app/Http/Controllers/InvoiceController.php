<?php

namespace App\Http\Controllers;

use App\Classes\DataTables\InvoicesTableBuilder;
use App\Http\Requests\DownloadPreviewInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Invoice;
use App\Models\Signature;
use App\Services\ContractorService;
use App\Services\InvoiceService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Request;
use Throwable;

class InvoiceController extends Controller
{
    private $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index(InvoicesTableBuilder $dataTable)
    {
        return view('pages.invoices.index', [
            'dataTable' => $dataTable
                ->setData(Auth::user()
                    ->invoices()
                    ->with('invoice_type')
                    ->get()
                    ->toArray())
                ->make()
        ]);
    }

    public function create()
    {
        return view('pages.invoices.dialogs.create', [
            'user' => Auth::user(),
            'signatures' => Auth::user()->signatures()->get(),
            'issue_date' => Carbon::now()->format('Y-m-d'),
            'sale_date' => Carbon::now()->format('Y-m-d'),
            'payment_due_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
            'payment_methods' => [
                __('translations.invoices.payment_method.transfer'),
                __('translations.invoices.payment_method.cash'),
                __('translations.invoices.payment_method.barter'),
                __('translations.invoices.payment_method.credit_card')
            ],
            'units_of_measure' => [
                __('translations.invoices.unit_of_measure.piece.short'),
                __('translations.invoices.unit_of_measure.kilogram.short'),
                __('translations.invoices.unit_of_measure.hour.short'),
            ],
            'vat_rates' => ['23', '8', '5', '0'],
        ]);
    }

    /**
     * @param StoreInvoiceRequest $request
     * @param ContractorService $contractorService
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(StoreInvoiceRequest $request, ContractorService $contractorService)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $signature = Signature::findOrFail($request->get('signature_id'));
            $contractor = $contractorService->updateOrCreateContractor($user, $request->get('buyer'));
            $invoice = $this->invoiceService->issue($user, $contractor, $signature, $request->get('invoice'));
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true, 'row' => $invoice]);
    }

    public function show(Request $request, Invoice $invoice)
    {
        return view('pages.invoices.dialogs.show', [
            'user' => Auth::user(),
            'invoice' => $invoice,
            'can_set_paid' => $this->invoiceService->canSetPaid($invoice),
            'can_set_sent' => $this->invoiceService->canSetSent($invoice),
            'can_delete' => $this->invoiceService->canDelete($invoice),
        ]);
    }

    public function download(DownloadPreviewInvoiceRequest $request, Invoice $invoice)
    {
        $filePath = base_path($invoice->file_path);
        $headers = ['Content-Type: application/pdf'];
        $fileName = time() . '.pdf';
        return response()->download($filePath, $fileName, $headers);
    }

    public function preview(DownloadPreviewInvoiceRequest $request, Invoice $invoice)
    {
        $filePath = base_path($invoice->file_path);
        $headers = ['Content-Type: application/pdf'];
        return response()->file($filePath, $headers);
    }

    public function set_paid(DownloadPreviewInvoiceRequest $request, Invoice $invoice)
    {
        if(!$this->invoiceService->canSetPaid($invoice)) {
            return abort(500, __('translations.invoices.exception.can_not_set_paid'));
        }
        $invoice->is_paid = 1;
        $invoice->save();

        return response()->json(['success' => true]);
    }

    public function set_sent(DownloadPreviewInvoiceRequest $request, Invoice $invoice)
    {
        if(!$this->invoiceService->canSetSent($invoice)) {
            return abort(500, __('translations.invoices.exception.can_not_set_sent'));
        }
        $invoice->is_sent = 1;
        $invoice->save();

        return response()->json(['success' => true]);
    }

    public function destroy(DownloadPreviewInvoiceRequest $request, Invoice $invoice)
    {
        if(!$this->invoiceService->canDelete($invoice)) {
            return abort(500, __('translations.invoices.exception.can_not_delete'));
        }

        $invoice->delete();

        return response()->json(['success' => true]);
    }
}
