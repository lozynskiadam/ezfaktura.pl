<?php

namespace App\Http\Controllers;

use App\Http\Helpers\DataTable;
use App\Http\Requests\EditDeleteSignature;
use App\Http\Requests\StoreUpdateSignature;
use App\Models\InvoiceType;
use App\Models\Signature;
use Illuminate\Support\Facades\Auth;

class SignatureController extends Controller
{
    public function index()
    {
        $dataTable = new DataTable();
        $dataTable->columns = [
          ['data' => 'name', 'title' => __('ID'), 'width' => 100],
          ['data' => 'description', 'title' => __('Opis')],
          ['data' => 'syntax', 'title' => __('Składnia')],
          ['data' => 'invoiceType', 'title' => __('Typy faktur'), 'width' => 150, 'className' => 'text-center', 'render' => 'App.view.renderer'],
        ];
        $dataTable->buttons = [
          [
            'text' => '<i class="fa fa-plus"></i> ' . __('Dodaj'),
            'action' => 'App.view.onAddClick',
            'className' => 'btn btn-primary btn-labeled'
          ]
        ];
        $dataTable->createdRow = 'App.view.onRowCreate';
        $dataTable->data = Auth::user()->signatures()->with('invoice_types')->get();

        return view('pages.signatures.index', [
          'dataTable' => $dataTable
        ]);
    }

    public function create()
    {
        return view('pages.signatures.edit', [
          'invoice_types' => InvoiceType::all()
        ]);
    }

    public function store(StoreUpdateSignature $request)
    {
        $signature = new Signature();
        $signature->user_id = Auth::id();
        $signature->fill($request->all());
        $signature->mode = $request->input('mode');
        $signature->save();

        $signature->invoice_types()->attach($request->get('invoice_types'));

        return ['row' => Signature::where('id', $signature->id)->with('invoice_types')->firstOrFail()];
    }

    public function edit(EditDeleteSignature $request, Signature $signature)
    {
        return view('pages.signatures.edit', [
          'signature' => $signature,
          'invoice_types' => InvoiceType::all()
        ]);
    }

    public function update(StoreUpdateSignature $request, Signature $signature)
    {
        $signature->fill($request->all());
        $signature->mode = $request->input('mode');
        $signature->save();

        $signature->invoice_types()->sync($request->get('invoice_types'));

        return ['row' => Signature::where('id', $signature->id)->with('invoice_types')->firstOrFail()];
    }

    public function destroy(EditDeleteSignature $request, Signature $signature)
    {
        $signature->delete();
        return true;
    }

}
