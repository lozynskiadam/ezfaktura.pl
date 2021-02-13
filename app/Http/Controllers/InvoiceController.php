<?php

namespace App\Http\Controllers;

use App\Classes\DataTable;
use App\Http\Requests\DownloadInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Contractor;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use InvoiceGenerator\Invoice AS InvoiceGenerator;
use InvoiceGenerator\InvoiceException;

class InvoiceController extends Controller
{
    public function index(DataTable $dataTable)
    {
        $dataTable->columns = [
            ['data' => 'invoice_type', 'title' => __('Typ'), 'width' => 60, 'className' => 'text-center', 'render' => 'Renderers.invoice_type'],
            ['data' => 'issue_date', 'title' => __('Data wystawienia'), 'width' => 130, 'className' => 'text-center'],
            ['data' => 'signature', 'title' => __('Sygnatura')],
            ['data' => 'buyer', 'title' => __('Kontrahent'), 'render' => 'Renderers.contractor'],
            ['data' => 'buyer', 'title' => __('NIP'), 'render' => 'Renderers.tax_id'],
            ['data' => 'net_total', 'title' => __('Netto'), 'render' => 'Renderers.currency', 'className' => 'text-right', 'type' => 'currency'],
            ['data' => 'gross_total', 'title' => __('Brutto'), 'render' => 'Renderers.currency', 'className' => 'text-right', 'type' => 'currency'],
        ];
        $dataTable->buttons = [
            [
                'text' => '<i class="fa fa-plus"></i> ' . __('Wystaw'),
                'action' => 'Pages_Invoices.onAddClick',
                'className' => 'btn btn-primary btn-labeled'
            ]
        ];
        $dataTable->createdRow = 'Pages_Invoices.onRowCreate';
        $dataTable->data = Auth::user()->invoices()->with('invoice_type')->get();

        return view('pages.invoices.index', [
            'dataTable' => $dataTable
        ]);
    }

    public function create()
    {
        return view('pages.invoices.create', [
            'user' => Auth::user(),
            'signatures' => Auth::user()->signatures()->get(),
            'issue_date' => date('Y-m-d'),
            'sale_date' => date('Y-m-d'),
            'delivery_date' => date('Y-m-d'),
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

        return response()->json(['row' => $invoice]);
    }

    public function download(DownloadInvoiceRequest $request, Invoice $invoice)
    {
        $filePath = base_path($invoice->file_path);
        $headers = ['Content-Type: application/pdf'];
        $fileName = time() . '.pdf';
        return response()->download($filePath, $fileName, $headers);
    }
}
