<div class="sidebar sidebar-style-2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          <img src="{{ Auth::user()->logo }}" alt="..." class="avatar-img rounded">
        </div>
        <div class="info">
          <a data-toggle="collapse" href="#profile-collapse">
            <span>
              <span class="user-name">{{ Auth::user()->name ?: Auth::user()->nip }}</span>
              <span class="user-level">{{ Auth::user()->email }}</span>
              <span class="caret"></span>
            </span>
          </a>
          <div class="clearfix"></div>

          <div class="collapse in @if (in_array(request()->path(), ['profile'])) show @endif" id="profile-collapse">
            <ul class="nav">
              <li class="@if (request()->path() == 'profile') active @endif">
              <a href="{{ route('profile.index') }}">
                <span class="link-collapse">{{ __('translations.menu.profile') }}</span>
              </a>
              </li>
              <li>
                <a href="{{ route('logout') }}">
                  <span class="link-collapse">{{ __('translations.menu.logout') }}</span>
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
            <p>{{ __('translations.menu.invoices_list') }}</p>
          </a>
        </li>

        @if(Auth::user()->hasModule(\App\Dictionaries\ModuleDictionary::TEMPLATES))
        <li class="nav-item @if (request()->path() == 'template') active @endif">
          <a href="{{ route('template.index') }}">
            <i class="fas fa-file-invoice"></i>
            <p>{{ __('translations.menu.template') }}</p>
          </a>
        </li>
        @endif

        @if(Auth::user()->hasModule(\App\Dictionaries\ModuleDictionary::SIGNATURES))
        <li class="nav-item @if (request()->path() == 'signatures') active @endif">
          <a href="{{ route('signatures.index') }}">
            <i class="fas fa-tag"></i>
            <p>{{ __('translations.menu.signatures') }}</p>
          </a>
        </li>
        @endif

        @if(Auth::user()->hasModule(\App\Dictionaries\ModuleDictionary::REPORTS))
        <li class="nav-item @if (request()->path() == 'reports') active @endif">
          <a href="{{ route('reports.index') }}">
            <i class="fas fa-chart-line"></i>
            <p>{{ __('translations.menu.reports') }}</p>
          </a>
        </li>
        @endif

        @if(Auth::user()->hasModule(\App\Dictionaries\ModuleDictionary::API))
        <li class="nav-item @if (request()->path() == 'api') active @endif">
          <a href="{{ route('api') }}">
            <i class="fab fa-cloudversify"></i>
            <p>{{ __('translations.menu.api') }}</p>
          </a>
        </li>
        @endif

      </ul>

      <hr/>

      <ul class="nav nav-primary">
        <li class="nav-item @if (request()->path() == 'modules') active @endif">
          <a href="{{ route('modules.index') }}">
            <i class="fas fa-plus-square"></i>
            <p>{{ __('translations.menu.modules') }}</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
