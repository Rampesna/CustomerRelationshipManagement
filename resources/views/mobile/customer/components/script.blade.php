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

    var companyIdCreate = $("#company_id_create");
    var countryIdCreate = $("#country_id_create");
    var provinceIdCreate = $("#province_id_create");
    var districtIdCreate = $("#district_id_create");
    var classIdCreate = $("#class_id_create");
    var typeIdCreate = $("#type_id_create");
    var referenceIdCreate = $("#reference_id_create");

    var companyIdEdit = $("#company_id_edit");
    var countryIdEdit = $("#country_id_edit");
    var provinceIdEdit = $("#province_id_edit");
    var districtIdEdit = $("#district_id_edit");
    var classIdEdit = $("#class_id_edit");
    var typeIdEdit = $("#type_id_edit");
    var referenceIdEdit = $("#reference_id_edit");

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");

    var customers = $('#customers').DataTable({
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
            var r = $('#customers tfoot tr');
            $('#customers thead').append(r);
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
            url: '{{ route('ajax.customer.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val()
                });
            },
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'company_id', name: 'company_id'},
            {data: 'title', name: 'title'},
            {data: 'tax_number', name: 'tax_number'},
            {data: 'email', name: 'email'},
            {data: 'country_id', name: 'country_id'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'class_id', name: 'class_id'},
            {data: 'type_id', name: 'type_id'},
            {data: 'reference_id', name: 'reference_id'}
        ],

        responsive: true,
        stateSave: true,
        select: 'single'
    });

    customers.on('select', function (e, dt, type, indexes) {
        var selectedRows = customers.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id.replace('#', '');
            $("#id_edit").val(id);
            $("#ShowButton").show();
            $("#EditButton").show();
        } else {
            $("#ShowButton").hide();
            $("#EditButton").hide();
        }
    }).on('deselect', function (e, dt, type, indexes) {
        $("#ShowButton").hide();
        $("#EditButton").hide();
    });

    function create() {
        $("#CreateForm").trigger('reset');
        companyIdCreate.val(SelectedCompany.val()).selectpicker('refresh');
        getCustomerClasses(SelectedCompany.val());
        getCustomerTypes(SelectedCompany.val());
        getCustomerReferences(SelectedCompany.val());
        $("#CreateModal").modal('show');
    }

    function edit() {
        $("#EditModal").modal('show');

        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.customer.show') }}',
            data: {
                id: id
            },
            success: function (customer) {
                $("#company_id_edit").val(customer.company_id).selectpicker('refresh');
                $("#title_edit").val(customer.title);
                $("#tax_number_edit").val(customer.tax_number);
                $("#tax_office").val(customer.tax_office);
                $("#email_edit").val(customer.email);
                $("#country_id_edit").val(customer.country_id).selectpicker('refresh');
                $("#phone_number_edit").val(customer.phone_number);
                getProvincesEdit();
                $("#province_id_edit").val(customer.province_id).selectpicker('refresh');
                getDistrictsEdit();
                $("#district_id_edit").val(customer.district_id).selectpicker('refresh');
                $("#website_edit").val(customer.website);
                $("#foundation_date_edit").val(customer.foundation_date);
                $("#class_id_edit").val(customer.class_id).selectpicker('refresh');
                $("#type_id_edit").val(customer.type_id).selectpicker('refresh');
                $("#reference_id_edit").val(customer.reference_id).selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function show() {
        var id = $("#id_edit").val();
        window.open('{{ route('mobile.customer.show') }}/' + id + '/index', '_blank');
    }

    function getCountries() {
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('ajax.country.index') }}',
            data: {},
            success: function (countries) {
                countryIdCreate.empty();
                countryIdEdit.empty();
                $.each(countries, function (index) {
                    countryIdCreate.append(`<option ${countries[index].short === 'TR' && countries[index].code === '90' ? 'selected' : null} value="${countries[index].id}">${countries[index].name} (+${countries[index].code})</option>`);
                    countryIdEdit.append(`<option ${countries[index].short === 'TR' && countries[index].code === '90' ? 'selected' : null} value="${countries[index].id}">${countries[index].name} (+${countries[index].code})</option>`);
                });
                countryIdCreate.selectpicker('refresh');
                countryIdEdit.selectpicker('refresh');
                getProvincesCreate();
                getProvincesEdit();
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getProvincesCreate() {
        var country_id = countryIdCreate.val();

        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('ajax.province.index') }}',
            data: {
                country_id: country_id
            },
            success: function (provinces) {
                provinceIdCreate.empty();
                $.each(provinces, function (index) {
                    provinceIdCreate.append(`<option value="${provinces[index].id}">${provinces[index].name}</option>`);
                });
                provinceIdCreate.selectpicker('refresh');
                getDistrictsCreate();
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getProvincesEdit() {
        var country_id = countryIdEdit.val();

        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('ajax.province.index') }}',
            data: {
                country_id: country_id
            },
            success: function (provinces) {
                provinceIdEdit.empty();
                $.each(provinces, function (index) {
                    provinceIdEdit.append(`<option value="${provinces[index].id}">${provinces[index].name}</option>`);
                });
                provinceIdEdit.selectpicker('refresh');
                getDistrictsEdit();
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getDistrictsCreate() {
        var province_id = provinceIdCreate.val();

        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('ajax.district.index') }}',
            data: {
                province_id: province_id
            },
            success: function (districts) {
                districtIdCreate.empty();
                $.each(districts, function (index) {
                    districtIdCreate.append(`<option value="${districts[index].id}">${districts[index].name}</option>`);
                });
                districtIdCreate.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getDistrictsEdit() {
        var province_id = provinceIdEdit.val();

        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('ajax.district.index') }}',
            data: {
                province_id: province_id
            },
            success: function (districts) {
                districtIdEdit.empty();
                $.each(districts, function (index) {
                    districtIdEdit.append(`<option value="${districts[index].id}">${districts[index].name}</option>`);
                });
                districtIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getCustomerClasses(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.customerClasses') }}',
            data: {
                company_id: company_id
            },
            success: function (classes) {
                classIdCreate.empty();
                classIdEdit.empty();
                $.each(classes, function (index) {
                    classIdCreate.append(`<option value="${classes[index].id}">${classes[index].name}</option>`);
                    classIdEdit.append(`<option value="${classes[index].id}">${classes[index].name}</option>`);
                });
                classIdCreate.selectpicker('refresh');
                classIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getCustomerTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.customerTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (types) {
                typeIdCreate.empty();
                typeIdEdit.empty();
                $.each(types, function (index) {
                    typeIdCreate.append(`<option value="${types[index].id}">${types[index].name}</option>`);
                    typeIdEdit.append(`<option value="${types[index].id}">${types[index].name}</option>`);
                });
                typeIdCreate.selectpicker('refresh');
                typeIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getCustomerReferences(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.customerReferences') }}',
            data: {
                company_id: company_id
            },
            success: function (references) {
                referenceIdCreate.empty();
                referenceIdEdit.empty();
                $.each(references, function (index) {
                    referenceIdCreate.append(`<option value="${references[index].id}">${references[index].name}</option>`);
                    referenceIdEdit.append(`<option value="${references[index].id}">${references[index].name}</option>`);
                });
                referenceIdCreate.selectpicker('refresh');
                referenceIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getCountries();
    getCustomerClasses(SelectedCompany.val());
    getCustomerTypes(SelectedCompany.val());
    getCustomerReferences(SelectedCompany.val());

    SelectedCompany.change(function () {
        getCustomerClasses(SelectedCompany.val());
        getCustomerTypes(SelectedCompany.val());
        getCustomerReferences(SelectedCompany.val());
        customers.ajax.reload().draw();
    });

    countryIdCreate.change(function () {
        getProvincesCreate();
    });

    provinceIdCreate.change(function () {
        getDistrictsCreate();
    });

    countryIdEdit.change(function () {
        getProvincesEdit();
    });

    provinceIdEdit.change(function () {
        getDistrictsEdit();
    });

    companyIdCreate.change(function () {
        getCustomerClasses($(this).val());
        getCustomerTypes($(this).val());
        getCustomerReferences($(this).val());
    });

    companyIdEdit.change(function () {
        getCustomerClasses($(this).val());
        getCustomerTypes($(this).val());
        getCustomerReferences($(this).val());
    });

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var company_id = $("#company_id_create").val();
        var title = $("#title_create").val();
        var tax_number = $("#tax_number_create").val();
        var tax_office = $("#tax_office_create").val();
        var email = $("#email_create").val();
        var country_id = $("#country_id_create").val();
        var phone_number = $("#phone_number_create").val();
        var province_id = $("#province_id_create").val();
        var district_id = $("#district_id_create").val();
        var website = $("#website_create").val();
        var foundation_date = $("#foundation_date_create").val();
        var class_id = $("#class_id_create").val();
        var type_id = $("#type_id_create").val();
        var reference_id = $("#reference_id_create").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else {
            saveCustomer({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                company_id: company_id,
                title: title,
                tax_number: tax_number,
                tax_office: tax_office,
                email: email,
                country_id: country_id,
                phone_number: phone_number,
                province_id: province_id,
                district_id: district_id,
                website: website,
                foundation_date: foundation_date,
                class_id: class_id,
                type_id: type_id,
                reference_id: reference_id,
            }, 'Yeni Müşteri Başarıyla Oluşturuldu', 'Müşteri Oluşturulurken Bir Hata Oluştu!', 0);
        }
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var company_id = $("#company_id_edit").val();
        var title = $("#title_edit").val();
        var tax_number = $("#tax_number_edit").val();
        var tax_office = $("#tax_office_edit").val();
        var email = $("#email_edit").val();
        var country_id = $("#country_id_edit").val();
        var phone_number = $("#phone_number_edit").val();
        var province_id = $("#province_id_edit").val();
        var district_id = $("#district_id_edit").val();
        var website = $("#website_edit").val();
        var foundation_date = $("#foundation_date_edit").val();
        var class_id = $("#class_id_edit").val();
        var type_id = $("#type_id_edit").val();
        var reference_id = $("#reference_id_edit").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else {
            saveCustomer({
                _token: '{{ csrf_token() }}',
                id: id,
                auth_user_id: auth_user_id,
                company_id: company_id,
                title: title,
                tax_number: tax_number,
                tax_office: tax_office,
                email: email,
                country_id: country_id,
                phone_number: phone_number,
                province_id: province_id,
                district_id: district_id,
                website: website,
                foundation_date: foundation_date,
                class_id: class_id,
                type_id: type_id,
                reference_id: reference_id,
            }, 'Müşteri Başarıyla Güncellendi', 'Müşteri Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    function saveCustomer(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.customer.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#CreateModal").modal('hide');
                } else if (direction === 1) {
                    $("#EditModal").modal('hide');
                }
                customers.ajax.reload().draw();
            },
            error: function (error) {
                toastr.error(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = customers.rows({selected: true});
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

    $('#customers tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            customers.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#customersCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            customers.rows().deselect();
        }
    });
</script>
