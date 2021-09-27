<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>
    const months = [
        'Ocak',
        'Şubat',
        'Mart',
        'Nisan',
        'Mayıs',
        'Haziran',
        'Temmuz',
        'Ağustos',
        'Eylül',
        'Ekim',
        'Kasım',
        'Aralık',
    ];

    var SelectedCompany = $("#SelectedCompany");

    var permissionsSelectorCreate = $("#permissions_create");

    var permissionsSelectorEdit = $("#permissions_edit");

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");

    var roles = $('#roles').DataTable({
        language: {
            info: "_TOTAL_ Kayıttan _START_ - _END_ Arasındaki Kayıtlar Gösteriliyor.",
            infoEmpty: "Gösterilecek Hiç Kayıt Yok.",
            loadingRecords: "Kayıtlar Yükleniyor.",
            zeroRecords: "Tablo Boş",
            search: "Arama:",
            infoFiltered: "(Toplam _MAX_ Kayıttan Filtrelenenler)",
            lengthMenu: "Sayfa Başı _MENU_ Kayıt Göster",
            sProcessing: "Yükleniyor...",
            paginate: {
                first: "İlk",
                previous: "Önceki",
                next: "Sonraki",
                last: "Son"
            },
            select: {
                rows: {
                    "_": "%d kayıt seçildi",
                    "0": "",
                    "1": "1 kayıt seçildi"
                }
            },
            buttons: {
                print: {
                    title: 'Yazdır'
                }
            }
        },

        dom: 'rtipl',

        order: [
            [
                0,
                "desc"
            ]
        ],

        processing: true,
        serverSide: true,
        ajax: {
            type: 'get',
            url: '{{ route('ajax.role.datatable') }}',
            data: {},
        },
        columns: [
            {data: 'id', name: 'id', width: '5%'},
            {data: 'name', name: 'name'},
        ],

        responsive: true,
        stateSave: true,
        select: 'single'
    });

    roles.on('select', function (e, dt, type, indexes) {
        var selectedRows = roles.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id;
            $("#id_edit").val(id);
            $("#EditButton").show();
        } else {
            $("#EditButton").hide();
        }
    }).on('deselect', function (e, dt, type, indexes) {
        $("#ShowButton").hide();
        $("#EditButton").hide();
    });

    function create() {
        $("#CreateForm").trigger('reset');
        permissionsSelectorCreate.selectpicker('refresh');
        $("#CreateModal").modal('show');
    }

    function edit() {
        $("#EditModal").modal('show');

        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.role.show') }}',
            data: {
                id: id
            },
            success: function (role) {
                $('#permissions_edit').val($.map(role.permissions, function (permission) {
                    return permission["id"];
                })).selectpicker('refresh');
                $("#name_edit").val(role.name);
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function drop() {

    }

    function getPermissions() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.permission.index') }}',
            data: {},
            success: function (permissions) {
                permissionsSelectorCreate.empty();
                permissionsSelectorEdit.empty();
                $.each(permissions, function (index) {
                    permissionsSelectorCreate.append(`<option value="${permissions[index].id}">${permissions[index].name}</option>`);
                    permissionsSelectorEdit.append(`<option value="${permissions[index].id}">${permissions[index].name}</option>`);
                });
                permissionsSelectorCreate.selectpicker('refresh');
                permissionsSelectorEdit.selectpicker('refresh');
            },
            error: function () {

            }
        });
    }

    getPermissions();

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var permissions = $("#permissions_create").val();
        var name = $("#name_create").val();

        if (name == null || name === '') {
            toastr.warning('Rol Adı Boş Olamaz!');
        } else {
            saveRole({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                permissions: permissions,
                name: name,
            }, 'Yeni Rol Başarıyla Oluşturuldu', 'Rol Oluşturulurken Bir Hata Oluştu!', 0);
        }
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var permissions = $("#permissions_edit").val();
        var name = $("#name_edit").val();

        if (name == null || name === '') {
            toastr.warning('Rol Adı Boş Olamaz!');
        } else {
            saveRole({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                id: id,
                permissions: permissions,
                name: name,
            }, 'Rol Başarıyla Güncellendi', 'Rol Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    function saveRole(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.role.save') }}',
            data: data,
            success: function () {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#CreateModal").modal('hide');
                } else if (direction === 1) {
                    $("#EditModal").modal('hide');
                }
                roles.ajax.reload().draw();
            },
            error: function (error) {
                toastr.error(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = roles.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id;
            $("#id_edit").val(id);
            $("#EditingContexts").show();
        } else {
            $("#EditingContexts").hide();
        }

        var top = e.pageY - 10;
        var left = e.pageX - 10;

        $("#context-menu").css({
            display: "block",
            top: top,
            left: left
        });

        return false;
    }).on("click", function () {
        $("#context-menu").hide();
    }).on('focusout', function () {
        $("#context-menu").hide();
    });

    $('#roles tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            roles.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#rolesCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            roles.rows().deselect();
        }
    });
</script>
