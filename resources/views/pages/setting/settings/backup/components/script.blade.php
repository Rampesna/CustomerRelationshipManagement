<script>

    var UpdateButton = $('#UpdateButton');

    function getBackupSettings() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.backupSetting.show') }}',
            data: {},
            success: function (backupSettings) {
                $('#database_backup_path').val(backupSettings.database_backup_path);
            },
            error: function () {

            }
        });
    }

    getBackupSettings();

    UpdateButton.click(function () {
        var database_backup_path = $('#database_backup_path').val();
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.backupSetting.update') }}',
            data: {
                _token: '{{ csrf_token() }}',
                database_backup_path: database_backup_path
            },
            success: function () {
                toastr.success('Başarıyla Güncellendi');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Güncelleme Yapılırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin!');
            }
        });
    });

</script>
