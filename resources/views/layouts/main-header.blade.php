<!--=================================
header start-->
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- logo -->
    <div class="text-left navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}"><img
                src="{{ URL::asset('assets/images/logo-dark.png') }}" alt=""></a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}"><img
                src="{{ URL::asset('assets/images/logo-icon-dark.png') }}" alt=""></a>


    </div>
    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item">
            <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left" href="javascript:void(0);"><i
                    class="zmdi zmdi-menu ti-align-right"></i></a>
        </li>

    </ul>
    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto">

        <div class="btn-group mb-1">
            <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @if (App::getLocale() == 'ar')
                    العربية
                @else
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                @endif
            </button>
            <div class="dropdown-menu">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <li class="nav-item fullscreen">
            <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
        </li>
        {{-- <li class="nav-item dropdown ">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="ti-bell"></i>
                <span class="badge badge-danger notification-status"> </span>
            </a>
             <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                <div class="dropdown-header notifications">
                    <strong>{{ trans('Sidebar_trans.Notifications') }}</strong>
                    <span class="badge badge-pill badge-warning">05</span>
                </div>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">New registered user <small
                        class="float-right text-muted time">Just now</small> </a>
                <a href="#" class="dropdown-item">New invoice received <small
                        class="float-right text-muted time">22 mins</small> </a>
                <a href="#" class="dropdown-item">Server error report<small class="float-right text-muted time">7
                        hrs</small> </a>
                <a href="#" class="dropdown-item">Database report<small class="float-right text-muted time">1
                        days</small> </a>
                <a href="#" class="dropdown-item">Order confirmation<small class="float-right text-muted time">2
                        days</small> </a>
            </div> --}}
        </li>

        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">
                <img src="{{ URL::asset('assets/images/user_icon.png') }}" alt="avatar">


            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                            <span>{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                @if (auth('student')->check())
                    <form method="GET" action="{{ route('logout', 'student') }}">
                    @elseif(auth('teacher')->check())
                        <form method="GET" action="{{ route('logout', 'teacher') }}">
                        @elseif(auth('parent')->check())
                            <form method="GET" action="{{ route('logout', 'parent') }}">
                            @else
                                <form method="GET" action="{{ route('logout', 'web') }}">
                @endif

                @csrf
                <a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();">
                    <i class="bx bx-log-out"></i>{{ trans('main_trans.logout') }}</a>
                </form>

            </div>
        </li>
    </ul>
</nav>

<!--=================================
header End-->
