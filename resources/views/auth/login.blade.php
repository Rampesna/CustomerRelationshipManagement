@extends('layouts.authentication')
@section('title', 'Giriş Yap')


@section('content')
    <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="login-aside d-flex flex-column flex-row-auto">
            <div class="d-flex flex-column-auto flex-column">
                <a href="{{ route('login') }}" class="login-logo text-center pb-10" style="margin-top: 100px">
                    <img src="{{ asset('assets/media/logos/otel_takip_sistemi_long_dark.png') }}" class="max-h-75px" alt="" />
                </a>
            </div>
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center" style="background-position-y: calc(95%); background-image: url({{ asset('assets/media/logos/bg.png') }});"></div>
        </div>
        <div class="login-content flex-row-fluid d-flex flex-column p-10">
            <div class="d-flex flex-row-fluid flex-center">
                <div class="login-form">
                    <form class="form" id="login" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="font-size-h6 font-weight-bolder text-dark">E-posta Adresiniz</label>
                            <input class="form-control h-auto py-7 px-6 rounded-lg border-0" type="email" name="email" id="email" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mt-n5">
                                <label for="password" class="font-size-h6 font-weight-bolder text-dark pt-5">Şifreniz</label>
                            </div>
                            <input class="form-control h-auto py-7 px-6 rounded-lg border-0" type="password" name="password" id="password" autocomplete="new-password" />
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <label class="checkbox checkbox-dark">
                                    <input type="checkbox" checked="checked" name="remember" /> Beni Hatırla
                                    <span></span>
                                </label>
                                <i class="fa fa-info-circle ml-3 mt-1" data-toggle="tooltip" data-placement="right" title="Aktif Ederseniz Oturumunuz Otomatik Olarak Sonlandırılmaz."></i>
                            </div>
                        </div>

                        <div class="pb-lg-0 pb-5">
                            <div class="row">
                                <div class="col-xl-4">
                                    <button type="submit" onclick="loginControl()" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Giriş Yap</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-styles')

@stop

@section('page-script')

    <script>

        var mail = $("#email");
        var pass = $("#password");

        function validateEmail(email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test(email);
        }

        function loginControl() {
            var email = mail.val();
            var password = pass.val();
            if (email == null || email === '') {
                toastr.warning('E-posta Adresinizi Girin');
            } else if (!validateEmail(email)) {
                toastr.warning('Lütfen Geçerli Bir E-posta Adresi Girin');
            } else if (password == null || password === '') {
                toastr.warning('Şifrenizi Girin');
            } else {
                $("#login").submit();
            }
        }

        mail.on('keypress', function (e) {
            if (e.which === 13) {
                if (mail.val() === '') {
                    toastr.warning('Lütfen Geçerli Bir E-posta Adresi Girin');
                } else {
                    if (!validateEmail(mail.val())) {
                        toastr.warning('Lütfen Geçerli Bir E-posta Adresi Girin');
                    } else {
                        pass.focus();
                    }
                }
            }
        });

        pass.on('keypress', function (e) {
            if (e.which === 13) {
                loginControl();
            }
        });

        @if(count($errors->all()) > 0)
        toastr.warning("{{ $errors->first() }}");
        @endif

    </script>

@stop
