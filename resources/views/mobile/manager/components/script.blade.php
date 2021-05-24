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

    var customerIdCreate = $("#customer_id_create");
    var departmentIdCreate = $("#department_id_create");
    var titleIdCreate = $("#title_id_create");

    var customerIdEdit = $("#customer_id_edit");
    var departmentIdEdit = $("#department_id_edit");
    var titleIdEdit = $("#title_id_edit");

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");

    var managers = $('#managers').DataTable({
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
            var r = $('#managers tfoot tr');
            $('#managers thead').append(r);
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
            url: '{{ route('ajax.manager.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val()
                });
            },
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'customer_id', name: 'customer_id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'gender', name: 'gender'},
            {data: 'department_id', name: 'department_id'},
            {data: 'title_id', name: 'title_id'},
        ],

        responsive: true,
        stateSave: true,
        select: 'single'
    });

    managers.on('select', function (e, dt, type, indexes) {
        var selectedRows = managers.rows({selected: true});
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
        $("#CreateModal").modal('show');
    }

    function edit() {
        $("#EditModal").modal('show');
        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.manager.show') }}',
            data: {
                id: id
            },
            success: function (manager) {
                SelectedCompany.val(manager.customer.company_id).selectpicker('refresh');
                getCustomers();
                getManagerDepartments();
                getManagerTitles();
                $("#customer_id_edit").val(manager.customer_id).selectpicker('refresh');
                $("#name_edit").val(manager.name);
                $("#email_edit").val(manager.email);
                $("#phone_number_edit").val(manager.phone_number);
                $("#gender_edit").val(manager.gender).selectpicker('refresh');
                $("#birth_date_edit").val(manager.birth_date);
                $("#department_id_edit").val(manager.department_id).selectpicker('refresh');
                $("#title_id_edit").val(manager.title_id).selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function drop() {

    }

    function getCustomers() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.customer.index') }}',
            data: {
                company_id: SelectedCompany.val()
            },
            success: function (customers) {
                customerIdCreate.empty();
                customerIdEdit.empty();
                $.each(customers, function (index) {
                    customerIdCreate.append(`<option value="${customers[index].id}">${customers[index].title}</option>`);
                    customerIdEdit.append(`<option value="${customers[index].id}">${customers[index].title}</option>`);
                });
                customerIdCreate.selectpicker('refresh');
                customerIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getManagerDepartments() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.managerDepartments') }}',
            data: {
                company_id: SelectedCompany.val()
            },
            success: function (departments) {
                departmentIdCreate.empty();
                departmentIdEdit.empty();
                $.each(departments, function (index) {
                    departmentIdCreate.append(`<option value="${departments[index].id}">${departments[index].name}</option>`);
                    departmentIdEdit.append(`<option value="${departments[index].id}">${departments[index].name}</option>`);
                });
                departmentIdCreate.selectpicker('refresh');
                departmentIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getManagerTitles() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.managerTitles') }}',
            data: {
                company_id: SelectedCompany.val()
            },
            success: function (titles) {
                titleIdCreate.empty();
                titleIdEdit.empty();
                $.each(titles, function (index) {
                    titleIdCreate.append(`<option value="${titles[index].id}">${titles[index].name}</option>`);
                    titleIdEdit.append(`<option value="${titles[index].id}">${titles[index].name}</option>`);
                });
                titleIdCreate.selectpicker('refresh');
                titleIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getCustomers();
    getManagerDepartments();
    getManagerTitles();

    SelectedCompany.change(function () {
        getCustomers();
        getManagerDepartments();
        getManagerTitles();
    });

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var customer_id = $("#customer_id_create").val();
        var name = $("#name_create").val();
        var email = $("#email_create").val();
        var phone_number = $("#phone_number_create").val();
        var gender = $("#gender_create").val();
        var birth_date = $("#birth_date_create").val();
        var department_id = $("#department_id_create").val();
        var title_id = $("#title_id_create").val();

        if (customer_id == null || customer_id === '') {
            toastr.warning('Müşteri Seçimi Yapılması Zorunludur!');
        } else {
            saveManager({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                customer_id: customer_id,
                name: name,
                email: email,
                phone_number: phone_number,
                gender: gender,
                birth_date: birth_date,
                department_id: department_id,
                title_id: title_id,
            }, 'Yeni Yetkili Başarıyla Oluşturuldu', 'Yetkili Oluşturulurken Bir Hata Oluştu!', 0);
        }
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var customer_id = $("#customer_id_edit").val();
        var name = $("#name_edit").val();
        var email = $("#email_edit").val();
        var phone_number = $("#phone_number_edit").val();
        var gender = $("#gender_edit").val();
        var birth_date = $("#birth_date_edit").val();
        var department_id = $("#department_id_edit").val();
        var title_id = $("#title_id_edit").val();

        if (customer_id == null || customer_id === '') {
            toastr.warning('Müşteri Seçimi Yapılması Zorunludur!');
        } else {
            saveManager({
                _token: '{{ csrf_token() }}',
                id: id,
                auth_user_id: auth_user_id,
                customer_id: customer_id,
                name: name,
                email: email,
                phone_number: phone_number,
                gender: gender,
                birth_date: birth_date,
                department_id: department_id,
                title_id: title_id,
            }, 'Yetkili Başarıyla Güncellendi', 'Yetkili Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    function saveManager(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.manager.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#CreateModal").modal('hide');
                } else if (direction === 1) {
                    $("#EditModal").modal('hide');
                }
                managers.ajax.reload().draw();
            },
            error: function (error) {
                toastr.success(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = managers.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id.replace('#', '');
            $("#id_edit").val(id);
            $("#EditingContexts").show();
        } else {
            $("#EditingContexts").hide();
        }

        return false;
    }).on("click", function () {
        $("#context-menu").hide();
    }).on('focusout', function () {
        $("#context-menu").hide();
    });

    $('#managers tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            managers.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#managersCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            managers.rows().deselect();
        }
    });
</script>
