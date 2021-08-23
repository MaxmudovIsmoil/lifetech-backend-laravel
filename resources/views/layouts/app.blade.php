<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Life Tech</title>
    <link rel="icon" href="{{ asset('logo.svg') }}" type="image/icon type">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('icons-css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form-validation.css') }}">
    @yield('style')
    <link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        .active {
            color: #fff !important;
            background: #321fdb !important;
        }
    </style>
{{--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-1"></script>--}}
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-118965717-1');
    </script>

</head>
<body class="c-app">
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <h3>Life Tech</h3>
    </div>
    <ul class="c-sidebar-nav ps ps--active-y">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link @if(Request::segment(1) == 'admin') active @endif" href="{{ route('admin') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-home') }}"></use>
                </svg>
                Bosh sahifa
            </a>
        </li>
        <li class="c-sidebar-nav-item @if(Request::segment(1) == 'course') active @endif">
            <a class="c-sidebar-nav-link" href="{{ route('course.index') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-layers') }}"></use>
                </svg>
                Kurslar
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link @if(Request::segment(1) == 'teacher') active @endif" href="{{ route('teacher.index') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-user') }}"></use>
                </svg>
                O'qituvchilar
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link @if(Request::segment(1) == 'student') active @endif" href="{{ route('student.newcomers') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-people') }}"></use>
                </svg>
                O'quvchilar
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link @if(Request::segment(1) == 'group') active @endif" href="{{ route('group.index',[1]) }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-library') }}"></use>
                </svg>
                Guruhlar
            </a>
        </li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown @if(Request::segment(1) == 'expense') c-show @endif" href="#">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-money') }}"></use>
                </svg> Harajatlar
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link @if((Request::segment(1) == 'expense') && (Request::segment(2) !== 'report')) active @endif" href="{{ route('expense.index', ['cost_type' => 0]) }}">
                        <span class="c-sidebar-nav-icon"></span> Harajat qo'shish
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link @if(Request::segment(1) == 'cost') active @endif" href="{{ route('cost.index') }}">
                        <span class="c-sidebar-nav-icon"></span> Harajat turi
                    </a>
                </li>
            </ul>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link @if(Request::segment(1) == 'report') active @endif" href="{{ route('report.index') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-bar-chart') }}"></use>
                </svg>
                Hisobot
            </a>
        </li>

    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>
<div class="c-wrapper c-fixed-components">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="{{ asset('icons/sprites/free.svg#cil-menu') }}"></use>
            </svg>
        </button>
        <a class="c-header-brand d-lg-none" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="{{ asset('icons/sprites/free.svg#full') }}"></use>
            </svg>
        </a>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-lg-show" responsive="true">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="{{ asset('icons/sprites/free.svg#cil-menu') }}"></use>
            </svg>
        </button>
        <ul class="c-header-nav d-md-down-none">
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Dashboard</a></li>
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Users</a></li>
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Settings</a></li>
        </ul>
        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('icons/sprites/free.svg#cil-bell')  }}"></use>
                    </svg>
                </a></li>
            <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('icons/sprites/free.svg#cil-list-rich') }}"></use>
                    </svg>
                </a></li>
            <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('icons/sprites/free.svg#cil-envelope-open') }}"></use>
                    </svg>
                </a></li>
            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar">User</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0 pb-0">
                    <!--                     <div class="dropdown-header bg-light py-2"><strong>Account</strong></div> -->

                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="{{ asset('icons/sprites/free.svg#cil-settings') }}"></use>
                        </svg>
                        Password update
                    </a>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg class="c-icon mr-2">
                            <use xlink:href="{{ asset('icons/sprites/free.svg#cil-account-logout') }}"></use>
                        </svg>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </li>
        </ul>
    </header>
    <div class="c-body">
        <main class="c-main p-3">
            <div class="container-fluid p-0">
                @yield('content')
            </div>
        </main>

    </div>
</div>

@include('layouts.deleteModal')


<script src="{{ asset('js/jQurey.js') }}"></script>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
<!--[if IE]><!-->
<script src="{{ asset('js/svgxuse.min.js') }}"></script>
<!--<![endif]-->

<script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
<script src="{{ asset('js/coreui-utils.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/datatable.js') }}"></script>

{{-- number format --}}
<script src="{{ asset('js/numeral.js') }}"></script>
<script src="{{ asset('js/form-validation.js') }}"></script>

<script src="{{ asset('js/functionDelete.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>

@yield('script')

</body>
</html>
