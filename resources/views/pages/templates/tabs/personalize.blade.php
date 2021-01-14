<div class="row">
  <div class="col-md-12">
    <h6 class="page-pretitle">{{ __('Wybór szablonu') }}</h6>
  </div>

  <div class="col-4 col-sm-3 col-md-2 col-lg-2 col-xl-2">
    <label class="imagecheck mb-4">
      <input name="imagecheck" type="radio" value="default" class="imagecheck-input" checked>
      <figure class="imagecheck-figure">
        <img src="/assets/img/invoice-templates/default.png" class="imagecheck-image">
      </figure>
    </label>
  </div>

  <div class="col-4 col-sm-3 col-md-2 col-lg-2 col-xl-2">
    <label class="imagecheck mb-4">
      <input name="imagecheck" type="radio" value="custom-1" class="imagecheck-input">
      <figure class="imagecheck-figure">
        <img src="/assets/img/invoice-templates/custom-1.png" class="imagecheck-image">
      </figure>
    </label>
  </div>

</div>

<div class="row">
  <div class="col-md-12">
    <h6 class="page-pretitle">{{ __('Kolumny') }}</h6>
  </div>
  <div class="col-md-12">
    <ul id="sortable" class="checklist list-group list-group-bordered">
      @foreach ($columns as $key => $column)
        <li class="list-group-item">
          <i class="fa fa-grip-vertical handle"></i>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck{{ $key }}" checked>
            <label class="custom-control-label" for="customCheck{{ $key }}">{{ $column }}</label>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>
