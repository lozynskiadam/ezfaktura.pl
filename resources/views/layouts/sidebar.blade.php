<div class="sidebar sidebar-style-2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          <img src="{{ Auth::user()->logo }}" alt="..." class="avatar-img rounded-circle">
        </div>
        <div class="info">
          <a data-toggle="collapse" href="#ProfileCollapse" aria-expanded="true">
            <span>
              <span class="user-name">{{ Auth::user()->name }}</span>
              <span class="user-level">{{ Auth::user()->email }}</span>
              <span class="caret"></span>
            </span>
          </a>
          <div class="clearfix"></div>

          <div class="collapse in" id="ProfileCollapse" style="padding: 0 5px;">
            <ul class="nav">
              <li>
              <a href="{{ route('profile.index') }}">
                <span class="link-collapse">{{ __('Edycja profilu') }}</span>
              </a>
              </li>
              <li>
                <a href="{{ route('logout') }}">
                  <span class="link-collapse">{{ __('Wyloguj') }}</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <ul class="nav nav-primary">

        <li class="nav-item @if (in_array(request()->path(), ['/', 'invoices'])) active @endif">
          <a href="{{ route('invoices.index') }}">
            <i class="far fa-copy"></i>
            <p>{{ __('Lista faktur') }}</p>
          </a>
        </li>

        <li class="nav-item @if (request()->path() == 'signatures') active @endif">
          <a href="{{ route('signatures.index') }}">
            <i class="fas fa-tag"></i>
            <p>{{ __('Sygnatury') }}</p>
          </a>
        </li>

        <li class="nav-item @if (request()->path() == 'template') active @endif">
          <a href="{{ route('template.index') }}">
            <i class="fas fa-file-invoice"></i>
            <p>{{ __('Szablon') }}</p>
          </a>
        </li>

        <li class="nav-item @if (request()->path() == 'api') active @endif">
          <a href="{{ route('api') }}">
            <i class="fab fa-cloudversify"></i>
            <p>{{ __('API') }}</p>
          </a>
        </li>

      </ul>
    </div>
  </div>
</div>
