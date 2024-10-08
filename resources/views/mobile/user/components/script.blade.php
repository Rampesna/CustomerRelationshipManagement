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

    var companiesSelectorCreate = $("#companies_create");
    var roleIdCreate = $("#role_id_create");

    var companiesSelectorEdit = $("#companies_edit");
    var roleIdEdit = $("#role_id_edit");

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");

    var users = $('#users').DataTable({
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

        initComplete: function () {
            var r = $('#users tfoot tr');
            $('#users thead').append(r);
            this.api().columns().every(function (index) {
                var column = this;
                var input = document.createElement('input');
                input.className = 'form-control';
                $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
            });
        },

        processing: true,
        serverSide: true,
        ajax: {
            type: 'get',
            url: '{{ route('ajax.user.datatable') }}',
            data: {},
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'role_id', name: 'role_id'},
        ],

        responsive: true,
        stateSave: true,
        select: 'single'
    });

    users.on('select', function (e, dt, type, indexes) {
        var selectedRows = users.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id.replace('#', '');
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
        companiesSelectorCreate.selectpicker('refresh');
        $("#CreateModal").modal('show');
    }

    function edit() {
        $("#EditModal").modal('show');

        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.user.show') }}',
            data: {
                id: id
            },
            success: function (user) {
                $('#companies_edit').val($.map(user.companies, function (company) {
                    return company["id"];
                })).selectpicker('refresh');
                $("#name_edit").val(user.name);
                $("#email_edit").val(user.email);
                $("#phone_number_edit").val(user.phone_number);
                $("#role_id_edit").val(user.role_id).selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function drop() {

    }

    function getCompanies() {
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('ajax.company.index') }}',
            data: {},
            success: function (companies) {
                companiesSelectorCreate.empty();
                companiesSelectorEdit.empty();
                $.each(companies, function (index) {
                    companiesSelectorCreate.append(`<option value="${companies[index].id}">${companies[index].name}</option>`);
                    companiesSelectorEdit.append(`<option value="${companies[index].id}">${companies[index].name}</option>`);
                });
                companiesSelectorCreate.selectpicker('refresh');
                companiesSelectorEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getRoles() {
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('ajax.role.index') }}',
            data: {},
            success: function (roles) {
                roleIdCreate.empty();
                roleIdEdit.empty();
                $.each(roles, function (index) {
                    roleIdCreate.append(`<option value="${roles[index].id}">${roles[index].name}</option>`);
                    roleIdEdit.append(`<option value="${roles[index].id}">${roles[index].name}</option>`);
                });
                roleIdCreate.selectpicker('refresh');
                roleIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getCompanies();
    getRoles();

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var companies = $("#companies_create").val();
        var name = $("#name_create").val();
        var email = $("#email_create").val();
        var phone_number = $("#phone_number_create").val();
        var password = $("#password_create").val();
        var role_id = $("#role_id_create").val();

        if (companies.length === 0) {
            toastr.warning('En Az (1) Firma Seçilmelidir!');
        } else if (name == null || name === '') {
            toastr.warning('Ad Soyad Boş Olamaz!');
        } else if (email == null || email === '') {
            toastr.warning('E-posta Adresi Boş Olamaz!');
        } else if (password == null || password === '') {
            toastr.warning('Şifre Boş Olamaz!');
        } else if (password.length < 8) {
            toastr.warning('Şifre En Az 8 Karakter Olmalıdır!');
        } else if (role_id == null || role_id === '') {
            toastr.warning('Rol Seçimi Zorunludur!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('ajax.user.emailControl') }}',
                data: {
                    email: email
                },
                success: function (response) {
                    if (response === true) {
                        toastr.warning('Bu E-posta Adresi Zaten Kullanılıyor!');
                    } else {
                        saveUser({
                            _token: '{{ csrf_token() }}',
                            auth_user_id: auth_user_id,
                            companies: companies,
                            name: name,
                            email: email,
                            phone_number: phone_number,
                            password: password,
                            role_id: role_id,
                        }, 'Yeni Kullanıcı Başarıyla Oluşturuldu', 'Kullanıcı Oluşturulurken Bir Hata Oluştu!', 0);
                    }
                },
                error: function (error) {
                    toastr.error('E-posta Kontrolü Yapılırken Sistemsel Bir Hata Oluştu!');
                    console.log(error)
                }
            });
        }
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var companies = $("#companies_edit").val();
        var name = $("#name_edit").val();
        var email = $("#email_edit").val();
        var phone_number = $("#phone_number_edit").val();
        var password = $("#password_edit").val();
        var role_id = $("#role_id_edit").val();

        if (companies.length === 0) {
            toastr.warning('En Az (1) Firma Seçilmelidir!');
        } else if (name == null || name === '') {
            toastr.warning('Ad Soyad Boş Olamaz!');
        } else if (email == null || email === '') {
            toastr.warning('E-posta Adresi Boş Olamaz!');
        } else if (password.length > 0 && password.length < 8) {
            toastr.warning('Şifre En Az 8 Karakter Olmalıdır!');
        } else if (role_id == null || role_id === '') {
            toastr.warning('Rol Seçimi Zorunludur!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('ajax.user.emailControl') }}',
                data: {
                    email: email,
                    except_id: id
                },
                success: function (response) {
                    if (response === true) {
                        toastr.warning('Bu E-posta Adresi Zaten Kullanılıyor!');
                    } else {
                        saveUser({
                            _token: '{{ csrf_token() }}',
                            auth_user_id: auth_user_id,
                            id: id,
                            companies: companies,
                            name: name,
                            email: email,
                            phone_number: phone_number,
                            password: password,
                            role_id: role_id,
                        }, 'Kullanıcı Başarıyla Güncellendi', 'Kullanıcı Güncellenirken Bir Hata Oluştu!', 1);
                    }
                },
                error: function (error) {
                    toastr.error('E-posta Kontrolü Yapılırken Sistemsel Bir Hata Oluştu!');
                    console.log(error);
                }
            });

        }
    });

    function saveUser(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.user.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#CreateModal").modal('hide');
                } else if (direction === 1) {
                    $("#EditModal").modal('hide');
                }
                users.ajax.reload().draw();
            },
            error: function (error) {
                toastr.error(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = users.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id.replace('#', '');
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

    $('#users tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            users.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#usersCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            users.rows().deselect();
        }
    });
</script>
