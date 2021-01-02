<div class="row">
  <div class="col-md-12 py-3 px-5">

    <div class="row">
      <div class="col-md-12">
        <h6 class="page-pretitle">Wybór szablonu</h6>
      </div>
      @for ($i = 0; $i < 3; $i++)
        <div class="col-4 col-sm-3 col-md-2 col-lg-2 col-xl-2">
          <label class="imagecheck mb-4">
            <input name="imagecheck" type="radio" value="{{ $i }}" class="imagecheck-input" @if ($i == 0) checked @endif>
            <figure class="imagecheck-figure">
              <img src="https://binaries.templates.cdn.office.net/support/templates/en-us/lt16400961_quantized.png"
                   alt="title" class="imagecheck-image">
            </figure>
          </label>
        </div>
      @endfor
    </div>

    <div class="row">
      <div class="col-md-12">
        <h6 class="page-pretitle">Kolumny</h6>
      </div>
      <div class="col-md-12">
        <ul id="sortable" class="checklist list-group list-group-bordered">
          @for ($i = 0; $i < 8; $i++)
            <li class="list-group-item">
              <i class="fa fa-grip-vertical handle"></i>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck{{ $i }}">
                <label class="custom-control-label" for="customCheck{{ $i }}">Unchecked</label>
              </div>
            </li>
          @endfor
        </ul>
      </div>
    </div>

  </div>
</div>