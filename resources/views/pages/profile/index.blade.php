@extends('layouts.master')

@section('content')
    <div class="page-navs bg-white">
        <div class="nav-scroller">
            <div class="nav nav-tabs nav-line nav-color-primary">
                <a class="nav-link active show" data-toggle="tab" href="#tab-main">
                    <i class="fa fa-edit mr-1"></i> {{ __('Informacje ogólne') }}
                </a>
                <a class="nav-link" data-toggle="tab" href="#tab-params">
                    <i class="fa fa-wrench mr-1"></i> {{ __('Parametry') }}
                </a>
            </div>
        </div>
    </div>

    <div class="page-inner">
        <div class="tab-content">
            @if(session()->has('message'))
                <div id="RequestMessage" class="alert alert-primary">{{ session()->get('message') }}</div>
            @endif
            <div class="tab-pane fade active show" id="tab-main" role="tabpanel">
                @include('pages.profile.tabs.main')
            </div>
            <div class="tab-pane fade" id="tab-params" role="tabpanel">
                @include('pages.profile.tabs.params')
            </div>
        </div>
    </div>
@stop
