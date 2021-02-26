@extends('layouts.master')

@section('scripts')
  @parent
  <script src="/assets/js/pages/api.js"></script>
  <script>window.addEventListener('load', Pages_Api.init);</script>
@stop

@section('content')
  <div class="page-navs bg-white">
    <div class="nav-scroller">
      <div class="nav nav-tabs nav-line nav-color-primary">
        <a class="nav-link active show" data-toggle="tab" href="#tab-key">
          <i class="fa fa-key mr-1"></i> {{ __('translations.api.key.title') }}
        </a>
      </div>
    </div>
  </div>

  <div class="page-inner">
    <div class="tab-content">
      @if(session()->has('message'))
        <div id="request-message" class="alert alert-primary">{{ session()->get('message') }}</div>
      @endif
      <div class="tab-pane fade active show" id="tab-key" role="tabpanel">
        @include('pages.api.tabs.key')
      </div>
    </div>
  </div>
@stop
