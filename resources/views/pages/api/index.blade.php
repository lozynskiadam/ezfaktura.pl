@extends('layouts.master')

@section('content')
  <div class="page-navs bg-white">
    <div class="nav-scroller">
      <div class="nav nav-tabs nav-line nav-color-primary">
        <a class="nav-link active show" data-toggle="tab" href="#tab-key">
          <i class="fa fa-key mr-1"></i> {{ __('Klucz API') }}
        </a>
        <a class="nav-link" data-toggle="tab" href="#tab-docs">
          <i class="fa fa-book mr-1"></i> {{ __('Dokumentacja') }}
        </a>
        <a class="nav-link" data-toggle="tab" href="#tab-logs">
          <i class="fa fa-history mr-1"></i> {{ __('Logi') }}
        </a>
      </div>
    </div>
  </div>

  <div class="page-inner">
    <div class="tab-content">
      @if(session()->has('message'))
        <div id="RequestMessage" class="alert alert-primary">{{ session()->get('message') }}</div>
      @endif
      <div class="tab-pane fade active show" id="tab-key" role="tabpanel">
        @include('pages.api.tabs.key')
      </div>
      <div class="tab-pane fade" id="tab-docs" role="tabpanel">
        @include('pages.api.tabs.docs')
      </div>
      <div class="tab-pane fade" id="tab-logs" role="tabpanel">
        @include('pages.api.tabs.logs')
      </div>
    </div>
  </div>
@stop
