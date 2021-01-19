<?php

namespace App\Http\Controllers;

use App\Classes\DataTable;
use App\Http\Requests\DownloadInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

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
            ['data' => 'gross_total', 'title' => __('Brutto'), 'render' => 'Renderers.currency', 'className' => 'text-right','type' => 'currency'],
        ];
        $dataTable->buttons = [
            [
                'text' => '<i class="fa fa-plus"></i> ' . __('Wystaw'),
                'action' => 'App.view.onAddClick',
                'className' => 'btn btn-primary btn-labeled'
            ]
        ];
        $dataTable->createdRow = 'App.view.onRowCreate';
        $dataTable->data = Auth::user()->invoices()->with('invoice_type')->get();

        return view('pages.invoices.index', [
            'dataTable' => $dataTable
        ]);
    }

    public function create()
    {
        return view('pages.invoices.create', [
            'user' => Auth::user()
        ]);
    }

    public function store(StoreInvoiceRequest $request)
    {
        $user = Auth::user();
        $generator = new \InvoiceGenerator\Invoice([
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
        $invoice->user_id = Auth::id();
        $invoice->invoice_type_id = 1;
        $invoice->file_path = $output;
        $invoice->fill((array) $generator);
        $invoice->save();

        return ['row' => Invoice::where('id', $invoice->id)->with('invoice_type')->firstOrFail()];
    }

    public function download(DownloadInvoiceRequest $request, Invoice $invoice)
    {
        $filePath = base_path($invoice->file_path);
        $headers = ['Content-Type: application/pdf'];
        $fileName = time().'.pdf';
        return response()->download($filePath, $fileName, $headers);
    }
}
