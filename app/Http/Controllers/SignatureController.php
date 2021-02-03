<?php

namespace App\Http\Controllers;

use App\Classes\DataTable;
use App\Http\Requests\EditDeleteSignatureRequest;
use App\Http\Requests\StoreUpdateSignatureRequest;
use App\Models\InvoiceType;
use App\Models\Signature;
use Illuminate\Support\Facades\Auth;

class SignatureController extends Controller
{
    public function index(DataTable $dataTable)
    {
        $dataTable->columns = [
            ['data' => 'name', 'title' => __('ID'), 'width' => 100],
            ['data' => 'description', 'title' => __('Opis')],
            ['data' => 'syntax', 'title' => __('Składnia')],
            ['data' => 'invoice_type', 'title' => __('Typy faktur'), 'width' => 150, 'className' => 'text-center', 'render' => 'Renderers.invoice_type'],
        ];
        $dataTable->buttons = [
            [
                'text' => '<i class="fa fa-plus"></i> ' . __('Dodaj'),
                'action' => 'Pages_Signatures.onAddClick',
                'className' => 'btn btn-primary btn-labeled'
            ]
        ];
        $dataTable->createdRow = 'Pages_Signatures.onRowCreate';
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

    public function store(StoreUpdateSignatureRequest $request)
    {
        $signature = new Signature();
        $signature->user_id = Auth::id();
        $signature->fill($request->validated());
        $signature->mode = $request->input('mode');
        $signature->save();

        $signature->invoice_types()->attach($request->get('invoice_types'));

        return ['row' => Signature::where('id', $signature->id)->with('invoice_types')->firstOrFail()];
    }

    public function edit(EditDeleteSignatureRequest $request, Signature $signature)
    {
        return view('pages.signatures.edit', [
            'signature' => $signature,
            'invoice_types' => InvoiceType::all()
        ]);
    }

    public function update(StoreUpdateSignatureRequest $request, Signature $signature)
    {
        $signature->fill($request->validated());
        $signature->mode = $request->input('mode');
        $signature->save();

        $signature->invoice_types()->sync($request->get('invoice_types'));

        return ['row' => Signature::where('id', $signature->id)->with('invoice_types')->firstOrFail()];
    }

    public function destroy(EditDeleteSignatureRequest $request, Signature $signature)
    {
        $signature->delete();
        return true;
    }

}
