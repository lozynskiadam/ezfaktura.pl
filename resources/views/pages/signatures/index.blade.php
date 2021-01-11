@extends('layouts.master')

@section('content')

  <x-header :title="__('Sygnatury')" :description="__('Opis do sygnatur')"/>

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