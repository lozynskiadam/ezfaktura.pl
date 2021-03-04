<?php

namespace App\Http\Controllers;

use App\Classes\DataTables\SignaturesTableBuilder;
use App\Http\Requests\EditDeleteSignatureRequest;
use App\Http\Requests\StoreUpdateSignatureRequest;
use App\Models\InvoiceType;
use App\Models\Signature;
use Illuminate\Support\Facades\Auth;

class SignatureController extends Controller
{
    public function index(SignaturesTableBuilder $dataTable)
    {
        return view('pages.signatures.index', [
            'dataTable' => $dataTable
                ->setData(Auth::user()
                    ->signatures()
                    ->with('invoice_types')
                    ->get()
                    ->toArray())
                ->make()
        ]);
    }

    public function create()
    {
        return view('pages.signatures.dialogs.edit', [
            'invoice_types' => InvoiceType::all()
        ]);
    }

    public function store(StoreUpdateSignatureRequest $request)
    {
        $signature = new Signature();
        $signature->user_id = Auth::id();
        $signature->fill($request->validated());
        $signature->save();

        $signature->invoice_types()->sync($request->get('invoice_types'));
        $signature->load(['invoice_types']);

        return response()->json(['row' => $signature]);
    }

    public function edit(EditDeleteSignatureRequest $request, Signature $signature)
    {
        return view('pages.signatures.dialogs.edit', [
            'signature' => $signature,
            'invoice_types' => InvoiceType::all()
        ]);
    }

    public function update(StoreUpdateSignatureRequest $request, Signature $signature)
    {
        $signature->fill($request->validated());
        $signature->save();
        $signature->invoice_types()->sync($request->get('invoice_types'));
        $signature->load(['invoice_types']);

        return response()->json(['row' => $signature]);
    }

    public function destroy(EditDeleteSignatureRequest $request, Signature $signature)
    {
        $signature->delete();

        return response()->json(['success' => true]);
    }

}
