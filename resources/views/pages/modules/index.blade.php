@extends('layouts.master')

@section('scripts')
  @parent
  <script src="/assets/js/pages/modules.js"></script>
  <script>window.addEventListener('load', Pages_Modules.init);</script>
@stop

@section('content')

  <div class="page-inner">
    <div class="row">

      @foreach($modules as $module)
      <div class="col-md-4">
        <div class="module-box @if($module->active) active @endif">
          <div class="module-icon">
            <i class="{{ $module->icon }}"></i>
          </div>
          <div class="module-content">
            <strong>{{ $module->name }}</strong>
            <small>{{ $module->description }}</small>
          </div>
          @if(!$module->basic)
            <div class="switcher">
              <input type="checkbox" id="module_{{ $module->id }}" value="{{ $module->id }}" @if($module->active) checked @endif>
              <label for="module_{{ $module->id }}"></label>
            </div>
          @endif
        </div>
      </div>
      @endforeach


    </div>
  </div>
@stop
