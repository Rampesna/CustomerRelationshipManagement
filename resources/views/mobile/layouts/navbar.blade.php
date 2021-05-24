<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" class="header header-fixed">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">

            </div>
            <!--end::Header Menu Wrapper-->
            <!--begin::Topbar-->
            <div class="topbar">

                <div class="mt-2 mr-3" style="width: 300px">
                    <div class="row">
                        <div class="col-xl-12">
                            <label style="width:100%">
                                <select class="form-control selectpicker" id="SelectedCompany">
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                </div>


                <div class="topbar-item">
                    <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hoşgeldiniz,</span>
                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ @$authenticated->name }}</span>
                        <span class="symbol symbol-35 symbol-light-success">
                            <span class="symbol-label font-size-h5 font-weight-bold">{{ substr(@$authenticated->name,0,1) }}</span>
                        </span>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!--end::Header-->
    <!--begin::Content-->

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div id="navbarControl" class="container-fluid loaded">

            @yield('content')

        </div>

    </div>
    <!--end::Content-->
    <!--begin::Footer-->
    @include('mobile.layouts.footer')
    <!--end::Footer-->
    @include('mobile.layouts.rightbar')
</div>
