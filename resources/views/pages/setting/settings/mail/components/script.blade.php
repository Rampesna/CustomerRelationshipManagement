<script>

    var SelectedCompany = $("#SelectedCompany");

    var UpdateButton = $("#UpdateButton");

    var mailHost = $("#mail_host");
    var mailPort = $("#mail_port");
    var mailEncryption = $("#mail_encryption");
    var mailUsername = $("#mail_username");
    var mailPassword = $("#mail_password");
    var mailFromEmail = $("#mail_from_email");
    var mailFromName = $("#mail_from_name");
    var mailRecipient = $("#mail_recipient");

    function getSettings() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.setting.show') }}',
            data: {
                company_id: SelectedCompany.val()
            },
            success: function (settings) {
                mailHost.val(settings.mail_host);
                mailPort.val(settings.mail_port);
                mailEncryption.val(settings.mail_encryption);
                mailUsername.val(settings.mail_username);
                mailPassword.val(settings.mail_password);
                mailFromEmail.val(settings.mail_from_email);
                mailFromName.val(settings.mail_from_name);
                mailRecipient.val(settings.mail_recipient);
            },
            error: function (error) {
                toastr.error('Mail Ayarları Alınırken Bir Hata Oluştu!');
                console.log(error);
            }
        });
    }

    getSettings();

    UpdateButton.click(function () {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.setting.updateMailSettings') }}',
            data: {
                _token: '{{ csrf_token() }}',
                company_id: SelectedCompany.val(),
                mail_host: mailHost.val(),
                mail_port: mailPort.val(),
                mail_encryption: mailEncryption.val(),
                mail_username: mailUsername.val(),
                mail_password: mailPassword.val(),
                mail_from_email: mailFromEmail.val(),
                mail_from_name: mailFromName.val(),
                mail_recipient: mailRecipient.val(),
            },
            success: function () {
                toastr.success('Bilgiler Güncellendi!');
            },
            error: function (error) {
                toastr.error('Bilgiler Güncellenirken Sistemsel Bir Hata Oluştu!');
                console.log(error);
            }
        });
    });

    SelectedCompany.change(function () {
        getSettings();
    });
</script>
