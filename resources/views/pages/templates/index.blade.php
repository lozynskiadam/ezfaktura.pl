@extends('layouts.master')

@section('scripts')
  @parent
  <script src="/assets/js/pages/templates.js"></script>
  <script>window.addEventListener('load', Pages_Templates.init);</script>
@stop

@section('content')
  <div class="page-navs bg-white">
    <div class="nav-scroller">
      <div class="nav nav-tabs nav-line nav-color-primary">
        <a class="nav-link active show" data-toggle="tab" href="#preview"><i
            class="fa fa-search"></i> {{ __('Podgląd') }}</a>
        <a class="nav-link" data-toggle="tab" href="#personalize"><i class="fa fa-magic"></i> {{ __('Personalizuj') }}
        </a>
      </div>
    </div>
  </div>

  <div class="page-inner">
    <div class="tab-content">
      @if(session()->has('message'))
        <div id="RequestMessage" class="alert alert-primary">{{ session()->get('message') }}</div>
      @endif
      <div class="tab-pane fade active show" id="preview" role="tabpanel">
        @include('pages.templates.tabs.preview')
      </div>
      <div class="tab-pane fade" id="personalize" role="tabpanel">
        @include('pages.templates.tabs.personalize')
      </div>
    </div>
  </div>
@stop
