@extends('layouts.master')

@section('content')
  <div class="page-navs bg-white">
    <div class="nav-scroller">
      <div class="nav nav-tabs nav-line nav-color-primary">
        <a class="nav-link active show" data-toggle="tab" href="#preview"><i class="fa fa-search"></i> {{ __('Podgląd') }}</a>
        <a class="nav-link" data-toggle="tab" href="#personalize"><i class="fa fa-magic"></i> {{ __('Personalizuj') }}</a>
      </div>
    </div>
  </div>

  <div class="tab-content">
    <div class="tab-pane fade active show" id="preview" role="tabpanel">
      @include('pages.templates.tabs.preview')
    </div>
    <div class="tab-pane fade" id="personalize" role="tabpanel">
      @include('pages.templates.tabs.personalize')
    </div>
  </div>
@stop
