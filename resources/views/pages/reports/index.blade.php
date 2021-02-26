@extends('layouts.master')

@section('scripts')
  @parent
  <script src="/assets/js/pages/reports.js"></script>
@stop

@section('content')
  <x-header :title="__('translations.reports.header')" :description="__('translations.reports.subheader')"/>

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