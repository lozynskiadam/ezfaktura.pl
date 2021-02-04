@extends('layouts.master')

@section('content')
  <x-header :title="__('Raporty')" :description="__('Lista możliwych do wygenerowania raportów')"/>

  <div class="page-inner mt--5">
    <div class="row mt--2">
      <div class="col-md-12">
        <div class="card full-height">
          <div class="card-body">
            <x-datatable name="ReportList" :dataTable="$dataTable"/>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop