<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

  <div class="container-fluid">
    <div class="collapse position-relative" id="search-nav">
      <form id="search-form" class="navbar-left navbar-form nav-search mr-md-2">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="btn btn-search pr-1">
              <i class="fa fa-search search-icon"></i>
            </span>
          </div>
          <input id="search" type="text" placeholder="{{ __('translations.search.placeholder') }} ..." class="form-control">
        </div>
      </form>
    </div>

    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
      <li class="nav-item toggle-nav-search hidden-caret">
        <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false"
           aria-controls="search-nav">
          <i class="fa fa-search"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#" id="manual" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-book" style="font-size: 22px;"></i>
        </a>
      </li>

      <li class="nav-item dropdown" style="border-left: 1px solid #0202021f; height: 40px;"></li>

      <li class="nav-item dropdown hidden-caret">
        <a class="nav-link dropdown-toggle" href="#" id="tasks" role="button" data-toggle="dropdown">
          <i class="fa fa-cogs" data-number="0"></i>
          <span class="counter"></span>
        </a>
      </li>

      <x-bell/>

      <li class="nav-item dropdown" style="border-left: 1px solid #0202021f; height: 40px;"></li>

      <li class="nav-item dropdown hidden-caret">
        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
          <div class="avatar-nav">
            <img src="{{ Auth::user()->logo }}" class="avatar-img rounded-circle">
          </div>
        </a>
        <ul class="dropdown-menu dropdown-user animated slideIn">
          <div class="dropdown-user-scroll scrollbar-outer">
            <li>
              <div class="user-box">
                <div class="avatar"><img src="{{ Auth::user()->logo }}" alt="image profile" class="avatar-img rounded"></div>
                <div class="u-text">
                  <h4>{{ Auth::user()->name }}</h4>
                  <p class="text-muted">{{ Auth::user()->email }}</p>
                </div>
              </div>
            </li>
            <li>
{{--              <div class="dropdown-divider"></div>--}}
{{--              <div class="text-center">--}}
{{--                <a class="dropdown-lang" href="{{ URL::to('language/en') }}"><img src="/assets/img/flags/gb.png"/> EN</a>--}}
{{--                <a class="dropdown-lang" href="{{ URL::to('language/pl') }}"><img src="/assets/img/flags/pl.png"/> PL</a>--}}
{{--              </div>--}}
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('app.profile.index') }}">{{ __('translations.menu.profile') }}</a>
              <a class="dropdown-item" href="{{ route('app.logout') }}">{{ __('translations.menu.logout') }}</a>
            </li>
          </div>
        </ul>
      </li>
    </ul>
  </div>
</nav>
