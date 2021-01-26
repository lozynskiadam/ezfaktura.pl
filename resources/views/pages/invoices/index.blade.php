@extends('layouts.master')

@section('scripts')
  @parent
  <script src="/assets/js/pages/invoices.js"></script>
@stop

@section('content')
  <x-header :title="__('Lista faktur')" :description="__('Spis faktur wystawionych na twoim koncie')"/>

  <div class="page-inner mt--5">
    <div class="row mt--2">
      <div class="col-md-12">
        <div class="card full-height">
          <div class="card-body">
            <x-datatable name="InvoiceList" :dataTable="$dataTable"/>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop