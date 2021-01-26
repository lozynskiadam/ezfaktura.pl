@extends('layouts.master')

@section('scripts')
  @parent
  <script src="/assets/js/pages/signatures.js"></script>
@stop

@section('content')
  <x-header :title="__('Sygnatury')" :description="__('Lista sygnatur fakturowych')"/>

  <div class="page-inner mt--5">
    <div class="row mt--2">
      <div class="col-md-12">
        <div class="card full-height">
          <div class="card-body">
            <x-datatable name="SignatureList" :dataTable="$dataTable"/>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop