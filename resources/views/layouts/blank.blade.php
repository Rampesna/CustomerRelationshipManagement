<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <base href="/">
    <meta charset="utf-8" />
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('meta_description', config('app.name'))" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <link href="{{ asset('assets/plugins/global/plugins.bundle.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/themes/layout/header/base/light.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/menu/light.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/brand/dark.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/aside/dark.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="{{ asset('assets/media/favicon/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />

    @stack('before-styles')

    @stack('after-styles')
    @if (trim($__env->yieldContent('page-styles')))
        @yield('page-styles')
    @endif

</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading example">
<div id="loader"></div>

<div class="QuickActions isHidden cursor-pointer" data-toggle="modal" data-target="#ManagementModal">
    <img class="QuickActions-button" src="{{ asset('assets/media/logos/quick-menu.png') }}" />
</div>

<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <a href="#">
        <img style="width: 30%; height: auto" alt="Logo" src="{{ asset('assets/media/logos/bien.png') }}" />
    </a>
    <div class="d-flex align-items-center">
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
        <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
            <span></span>
        </button>
        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
            <span class="svg-icon svg-icon-xl">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
            </span>
        </button>
    </div>
</div>

<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

            <div id="navbarControl" class="container-fluid loaded">

                @yield('content')

            </div>

        </div>
    </div>
</div>

@stack('before-scripts')

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js?v=7.0.3') }}"></script>

@stack('after-scripts')

<script src="{{ asset('assets/js/pages/crud/forms/widgets/input-mask.js?v=7.0.3') }}"></script>

@if (trim($__env->yieldContent('page-script')))
    @yield('page-script')
@endif

<script src="{{ asset('assets/js/custom.js') }}"></script>
@include('layouts.custom-scripts')

</body>
</html>
