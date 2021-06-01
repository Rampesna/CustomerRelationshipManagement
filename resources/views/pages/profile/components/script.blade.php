<script>
    var updateProfile = $("#updateProfile");
    var updatePassword = $("#updatePassword");

    updateProfile.click(function () {
        var name = $("#name").val();
        var phone_number = $("#phone_number").val();

        if (name == null || name === '') {
            toastr.warning('Ad Soyad Boş Olamaz!');
        } else {
            $.ajax({
                type: 'post',
                url: '{{ route('ajax.profile.updateProfile') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: '{{ auth()->user()->id() }}',
                    name: name,
                    phone_number: phone_number
                },
                success: function (response) {
                    if (response.type === 'success') {
                        toastr.success(response.message);
                    } else if (response.type === 'error') {
                        toastr.error(response.message);
                    } else if (response.type === 'warning') {
                        toastr.warning(response.message);
                    } else {
                        toastr.info(response.message);
                    }
                },
                error: function (error) {
                    toastr.error('Bir Hata Oluştu!');
                    console.log(error)
                }
            });
        }
    });

    updatePassword.click(function () {
        var old_password = $("#old_password").val();
        var new_password = $("#new_password").val();
        var confirm_new_password = $("#confirm_new_password").val();

        if (old_password == null || old_password === '') {
            toastr.warning('Eski Şifrenizi Girmediniz!');
        } else if (new_password == null || new_password === '') {
            toastr.warning('Yeni Şifre Boş Olamaz!');
        } else if (confirm_new_password == null || confirm_new_password === '') {
            toastr.warning('Yeni Şifrenizi Tekrar Girmediniz!');
        } else if (new_password !== confirm_new_password) {
            toastr.warning('Yeni Şifreniz Uyuşmuyor!');
        } else {
            $.ajax({
                type: 'post',
                url: '{{ route('ajax.profile.updatePassword') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: '{{ auth()->user()->id() }}',
                    old_password: old_password,
                    password: new_password
                },
                success: function (response) {
                    if (response.type === 'success') {
                        toastr.success(response.message);
                    } else if (response.type === 'error') {
                        toastr.error(response.message);
                    } else if (response.type === 'warning') {
                        toastr.warning(response.message);
                    } else {
                        toastr.info(response.message);
                    }
                    $("#updatePasswordForm").trigger('reset');
                },
                error: function (error) {
                    toastr.error('Bir Hata Oluştu!');
                    console.log(error)
                }
            });
        }
    });
</script>
