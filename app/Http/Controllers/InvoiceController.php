<?php

namespace App\Http\Controllers;

use App\Classes\DataTables\InvoicesTableBuilder;
use App\Http\Requests\DownloadPreviewInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Invoice;
use App\Services\ContractorService;
use App\Services\InvoiceService;
use App\Services\SignatureService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class InvoiceController extends Controller
{
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
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(StoreInvoiceRequest $request)
    {
        DB::beginTransaction();

        $user = Auth::user();
        $contractor = (new ContractorService)->updateOrCreateContractor($user->id, $request->get('buyer'));
        $signature_entry = (new SignatureService)->addEntry($request->get('signature_id'), $request->get('issue_date'));
        $invoice = (new InvoiceService)->createInvoice($user->id, $contractor->id, $signature_entry->id, $request->get('invoice'));

        DB::commit();

        return response()->json(['row' => $invoice]);
    }

    public function show(Request $request, Invoice $invoice, InvoiceService $service)
    {
        return view('pages.invoices.dialogs.show', [
            'user' => Auth::user(),
            'invoice' => $invoice,
            'can_set_paid' => $service->canSetPaid($invoice),
            'can_set_sent' => $service->canSetSent($invoice),
            'can_delete' => $service->canDelete($invoice),
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

    public function set_paid(DownloadPreviewInvoiceRequest $request, Invoice $invoice, InvoiceService $service)
    {
        if(!$service->canSetPaid($invoice)) {
            return abort(500, __('translations.invoices.exception.can_not_set_paid'));
        }
        $invoice->is_paid = 1;
        $invoice->save();

        return response()->json(['success' => true]);
    }

    public function set_sent(DownloadPreviewInvoiceRequest $request, Invoice $invoice, InvoiceService $service)
    {
        if(!$service->canSetSent($invoice)) {
            return abort(500, __('translations.invoices.exception.can_not_set_sent'));
        }
        $invoice->is_sent = 1;
        $invoice->save();

        return response()->json(['success' => true]);
    }

    public function destroy(DownloadPreviewInvoiceRequest $request, Invoice $invoice, InvoiceService $service)
    {
        if(!$service->canDelete($invoice)) {
            return abort(500, __('translations.invoices.exception.can_not_delete'));
        }

        DB::beginTransaction();

        $invoice->signature_entry()->first()->delete();
        $invoice->delete();

        DB::commit();

        return response()->json(['success' => true]);
    }
}
