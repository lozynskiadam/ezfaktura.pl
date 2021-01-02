@extends('layouts.master')

@section('content')

  <x-header :title="__('Edycja profilu')" :description="__('Opis do edycji profilu')"/>

  <div class="page-inner mt--5">
    <div class="row mt--2">
      <div class="col-md-12">
        <div class="card full-height">
          <div class="card-body">

            <div class="row">
              <div class="col-3 col-md-2">
                <div class="nav flex-column nav-pills nav-primary nav-pills-no-bd nav-pills-icons" id="v-pills-tab-with-icon" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active show" id="v-pills-home-tab-icons" data-toggle="pill" href="#tab-profile" aria-selected="true">
                    <i class="flaticon-user-4"></i>
                    Moja firma
                  </a>
                  <a class="nav-link" id="v-pills-profile-tab-icons" data-toggle="pill" href="#tab-params" role="tab" aria-selected="false">
                    <i class="flaticon-interface-4"></i>
                    Parametry
                  </a>
                  <a class="nav-link" id="v-pills-profile-tab-icons" data-toggle="pill" href="#tab-quick-actions" role="tab" aria-selected="false">
                    <i class="flaticon-stopwatch"></i>
                    Akcje szybkiego dostępu
                  </a>
                </div>
              </div>


              <div class="col-9 col-md-10">
                <div class="tab-content">

                  <div class="tab-pane fade active show" id="tab-profile" role="tabpanel">
                    <h2>Params</h2>
                    <form>
                      <div class="form-group row">
                        <label for="name" class="col-form-label col-md-2">{{ __('Nazwa') }}</label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" id="name" name="name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="syntax" class="col-form-label col-md-2">{{ __('Składnia') }}</label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" id="syntax" name="syntax" placeholder="FV/{year}/{month}/{counter}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-form-label col-md-2">{{ __('Opis') }}</label>
                        <div class="col-md-10">
                          <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="tab-pane fade" id="tab-params" role="tabpanel">
                    <h2>Params</h2>
                  </div>

                  <div class="tab-pane fade" id="tab-quick-actions" role="tabpanel">
                    <h2>Quick Access Actions</h2>
                  </div>


                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
@stop