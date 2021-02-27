<?php

namespace App\Http\Controllers;

use App\Classes\DataTables\InvoicesTableBuilder;
use App\Http\Requests\DownloadPreviewInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Contractor;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use InvoiceGenerator\Invoice AS InvoiceGenerator;
use InvoiceGenerator\InvoiceException;
use Request;

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
                    ->translate('invoice_type.initials')
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
     * @throws InvoiceException
     */
    public function store(StoreInvoiceRequest $request)
    {
        $user = Auth::user();

        $contractor = $user->contractors()->where('nip', $request->get('buyer_nip'))->first() ?? new Contractor();
        $contractor->user_id = $user->id;
        $contractor->name = $request->get('buyer_name');
        $contractor->address = $request->get('buyer_address');
        $contractor->city = $request->get('buyer_city');
        $contractor->postcode = $request->get('buyer_postcode');
        $contractor->nip = $request->get('buyer_nip');
        $contractor->save();

        $generator = new InvoiceGenerator([
            'payment_due_date' => $request->get('payment_due_date'),
            'payment_method' => $request->get('payment_method'),
            'seller' => [
                'name' => $user->name,
                'address' => $user->address,
                'city' => $user->city,
                'zip_code' => $user->postcode,
                'tax_id' => $user->nip,
            ],
            'buyer' => [
                'name' => $request->get('buyer_name'),
                'address' => $request->get('buyer_address'),
                'city' => $request->get('buyer_city'),
                'zip_code' => $request->get('buyer_postcode'),
                'tax_id' => $request->get('buyer_nip'),
            ],
            'positions' => $request->get('positions'),
        ]);
        $output = '/generated/' . time() . '.pdf';
        $generator->pdf(['output' => base_path($output)]);

        $invoice = new Invoice();
        $invoice->fill((array)$generator);
        $invoice->user_id = $user->id;
        $invoice->signature_id = $request->get('signature_id');
        $invoice->invoice_type_id = 1;
        $invoice->file_path = $output;
        $invoice->save();
        $invoice->load(['invoice_type']);
        $invoice->invoice_type->initials = __($invoice->invoice_type->initials);

        return response()->json(['row' => $invoice]);
    }

    public function show(Request $request, Invoice $invoice)
    {
        return view('pages.invoices.dialogs.show', [
            'user' => Auth::user(),
            'invoice' => $invoice,
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
        $invoice->is_paid = 1;
        $invoice->save();

        return response()->json(['success' => true]);
    }

    public function set_sent(DownloadPreviewInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->is_sent = 1;
        $invoice->save();

        return response()->json(['success' => true]);
    }

    public function destroy(DownloadPreviewInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->delete();

        return response()->json(['success' => true]);
    }
}
