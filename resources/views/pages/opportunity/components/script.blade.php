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

    var BODY = $('body');

    var SelectedCompany = $("#SelectedCompany");
    var companyIdCreate = $("#company_id_create");
    var userIdCreate = $("#user_id_create");
    var customerIdCreate = $("#customer_id_create");
    var countryIdCreate = $("#country_id_create");
    var provinceIdCreate = $("#province_id_create");
    var districtIdCreate = $("#district_id_create");
    var priorityIdCreate = $("#priority_id_create");
    var accessTypeIdCreate = $("#access_type_id_create");
    var estimatedResultTypeIdCreate = $("#estimated_result_type_id_create");
    var capacityTypeIdCreate = $("#capacity_type_id_create");
    var statusIdCreate = $("#status_id_create");

    var companyIdEdit = $("#company_id_edit");
    var userIdEdit = $("#user_id_edit");
    var customerIdEdit = $("#customer_id_edit");
    var countryIdEdit = $("#country_id_edit");
    var provinceIdEdit = $("#province_id_edit");
    var districtIdEdit = $("#district_id_edit");
    var priorityIdEdit = $("#priority_id_edit");
    var accessTypeIdEdit = $("#access_type_id_edit");
    var estimatedResultTypeIdEdit = $("#estimated_result_type_id_edit");
    var capacityTypeIdEdit = $("#capacity_type_id_edit");
    var statusIdEdit = $("#status_id_edit");

    var brandsCreate = $('#brands_create');
    var sectorsCreate = $('#sectors_create');
    var brandsEdit = $('#brands_edit');
    var sectorsEdit = $('#sectors_edit');

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");
    var DeleteButton = $("#DeleteButton");
    var ImportExcelButton = $("#ImportExcelButton");
    var AcceptCreateCustomerFromOpportunityButton = $("#AcceptCreateCustomerFromOpportunityButton");
    var RedirectButton = $("#RedirectButton");
    var RejectRedirectButton = $("#RejectRedirectButton");

    var opportunities = $('#opportunities').DataTable({
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

        dom: 'Brtipl',

        order: [
            [
                0,
                "desc"
            ]
        ],

        buttons: [
            {
                extend: 'collection',
                text: '<i class="fa fa-download"></i> Dışa Aktar',
                buttons: [
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF İndir'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> Excel İndir'
                    }
                ]
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Yazdır'
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-columns"></i> Sütunlar'
            },
            {
                text: '<i class="fas fa-undo"></i> Yenile',
                action: function (e, dt, node, config) {
                    $('table input').val('');
                    opportunities.search('').columns().search('').ajax.reload().draw();
                    console.log(opportunities.ajax.json())
                }
            }
        ],

        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "Tümü"]
        ],

        initComplete: function () {
            var r = $('#opportunities tfoot tr');
            $('#opportunities thead').append(r);
            this.api().columns().every(function (index) {
                var column = this;
                var input = document.createElement('input');
                if (index === 4) {
                    input.setAttribute("type", "date");
                }
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
            url: '{{ route('ajax.opportunity.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val()
                });
            },
        },
        columns: [
            {data: 'id', name: 'id', width: '5%'},
            {data: 'customer_id', name: 'customer_id'},
            {data: 'name', name: 'name'},
            {data: 'company_id', name: 'company_id'},
            {data: 'date', name: 'date'},
            {data: 'province_id', name: 'province_id'},
            {data: 'priority_id', name: 'priority_id'},
            {data: 'user_id', name: 'user_id'},
            {data: 'status_id', name: 'status_id'},
        ],

        responsive: true,
        stateSave: true,
        colReorder: true,
        select: 'single'
    });

    var CreateRightBar = function () {
        var _element;
        var _offcanvasObject;

        var _init = function () {
            var header = KTUtil.find(_element, '.offcanvas-header');
            var content = KTUtil.find(_element, '.offcanvas-content');

            _offcanvasObject = new KTOffcanvas(_element, {
                overlay: true,
                baseClass: 'offcanvas',
                placement: 'right',
                closeBy: 'create_rightbar_close',
                toggleBy: 'create_rightbar_toggle'
            });

            KTUtil.scrollInit(content, {
                disableForMobile: true,
                resetHeightOnDestroy: true,
                handleWindowResize: true,
                height: function () {
                    var height = parseInt(KTUtil.getViewPort().height);

                    if (header) {
                        height = height - parseInt(KTUtil.actualHeight(header));
                        height = height - parseInt(KTUtil.css(header, 'marginTop'));
                        height = height - parseInt(KTUtil.css(header, 'marginBottom'));
                    }

                    if (content) {
                        height = height - parseInt(KTUtil.css(content, 'marginTop'));
                        height = height - parseInt(KTUtil.css(content, 'marginBottom'));
                    }

                    height = height - parseInt(KTUtil.css(_element, 'paddingTop'));
                    height = height - parseInt(KTUtil.css(_element, 'paddingBottom'));

                    height = height - 2;

                    return height;
                }
            });
        }

        // Public methods
        return {
            init: function () {
                _element = KTUtil.getById('CreateRightbar');

                if (!_element) {
                    return;
                }

                // Initialize
                _init();
            },

            getElement: function () {
                return _element;
            }
        };
    }();
    CreateRightBar.init();

    var EditRightBar = function () {
        var _element;
        var _offcanvasObject;

        var _init = function () {
            var header = KTUtil.find(_element, '.offcanvas-header');
            var content = KTUtil.find(_element, '.offcanvas-content');

            _offcanvasObject = new KTOffcanvas(_element, {
                overlay: true,
                baseClass: 'offcanvas',
                placement: 'right',
                closeBy: 'edit_rightbar_close',
                toggleBy: 'edit_rightbar_toggle'
            });

            KTUtil.scrollInit(content, {
                disableForMobile: true,
                resetHeightOnDestroy: true,
                handleWindowResize: true,
                height: function () {
                    var height = parseInt(KTUtil.getViewPort().height);

                    if (header) {
                        height = height - parseInt(KTUtil.actualHeight(header));
                        height = height - parseInt(KTUtil.css(header, 'marginTop'));
                        height = height - parseInt(KTUtil.css(header, 'marginBottom'));
                    }

                    if (content) {
                        height = height - parseInt(KTUtil.css(content, 'marginTop'));
                        height = height - parseInt(KTUtil.css(content, 'marginBottom'));
                    }

                    height = height - parseInt(KTUtil.css(_element, 'paddingTop'));
                    height = height - parseInt(KTUtil.css(_element, 'paddingBottom'));

                    height = height - 2;

                    return height;
                }
            });
        }

        // Public methods
        return {
            init: function () {
                _element = KTUtil.getById('EditRightbar');

                if (!_element) {
                    return;
                }

                // Initialize
                _init();
            },

            getElement: function () {
                return _element;
            }
        };
    }();
    EditRightBar.init();

    function importExcel() {
        $("#ImportExcelModal").modal('show');
    }

    function create() {
        getCustomers(SelectedCompany.val());
        getOpportunityPriorities(SelectedCompany.val());
        getOpportunityAccessTypes(SelectedCompany.val());
        getOpportunityEstimatedResultTypes(SelectedCompany.val());
        getOpportunityCapacityTypes(SelectedCompany.val());
        getOpportunityStatuses(SelectedCompany.val());
        $("#CreateForm").trigger('reset');
        companyIdCreate.val(SelectedCompany.val()).selectpicker('refresh');
        userIdCreate.selectpicker('refresh');
        customerIdCreate.selectpicker('refresh');
        countryIdCreate.selectpicker('refresh');
        getCountries();
        provinceIdCreate.selectpicker('refresh');
        districtIdCreate.selectpicker('refresh');
        priorityIdCreate.selectpicker('refresh');
        accessTypeIdCreate.selectpicker('refresh');
        estimatedResultTypeIdCreate.selectpicker('refresh');
        capacityTypeIdCreate.selectpicker('refresh');
        accessTypeIdCreate.selectpicker('refresh');
        statusIdCreate.selectpicker('refresh');
        brandsCreate.selectpicker('refresh');
        sectorsCreate.selectpicker('refresh');
        $("#calendar_create").selectpicker('refresh');
        $("#create_rightbar_toggle").trigger('click');
    }

    function edit() {
        $("#edit_rightbar_toggle").trigger('click');

        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.opportunity.show') }}',
            data: {
                id: id
            },
            success: function (opportunity) {
                $("#company_id_edit").val(opportunity.company_id).selectpicker('refresh');
                $("#user_id_edit").val(opportunity.user_id).selectpicker('refresh');
                $("#customer_id_edit").val(opportunity.customer_id).selectpicker('refresh');
                $("#name_edit").val(opportunity.name);
                $("#email_edit").val(opportunity.email);
                $("#identification_number_edit").val(opportunity.identification_number);
                $("#domestic_edit").val(opportunity.domestic).selectpicker('refresh');
                $("#country_id_edit").val(opportunity.country_id).selectpicker('refresh');
                $("#phone_number_edit").val(opportunity.phone_number);
                $("#province_id_edit").val(opportunity.province_id).selectpicker('refresh');
                $("#district_id_edit").val(opportunity.district_id).selectpicker('refresh');
                $("#website_edit").val(opportunity.website);
                $("#foundation_date_edit").val(opportunity.foundation_date);
                $("#manager_name_edit").val(opportunity.manager_name);
                $("#manager_email_edit").val(opportunity.manager_email);
                $("#manager_phone_number_edit").val(opportunity.manager_phone_number);
                $("#date_edit").val(opportunity.date);
                $("#price_edit").val(opportunity.price);
                $("#currency_edit").val(opportunity.currency).selectpicker('refresh');
                $("#priority_id_edit").val(opportunity.priority_id).selectpicker('refresh');
                $("#access_type_id_edit").val(opportunity.access_type_id).selectpicker('refresh');
                $("#estimated_result_edit").val(opportunity.estimated_result);
                $("#estimated_result_type_id_edit").val(opportunity.estimated_result_type_id).selectpicker('refresh');
                $("#capacity_edit").val(opportunity.capacity);
                $("#capacity_type_id_edit").val(opportunity.capacity_type_id).selectpicker('refresh');
                $("#status_id_edit").val(opportunity.status_id).selectpicker('refresh');
                $("#description_edit").val(opportunity.description);
                $("#brands_edit").val($.map(opportunity.brands, function (brand) {
                    return brand["id"];
                })).selectpicker('refresh');
                $("#sectors_edit").val($.map(opportunity.sectors, function (sector) {
                    return sector["id"];
                })).selectpicker('refresh');
                $("#calendar_edit").val(opportunity.calendar).selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function show() {
        var id = $("#id_edit").val();
        window.open('{{ route('opportunity.show') }}/' + id + '/index', '_blank');
    }

    function createCustomerFromOpportunity() {
        var selectedRows = opportunities.rows({selected: true});
        if (selectedRows.count() > 0) {
            $("#converting").html(selectedRows.data()[0].name ?? '');
        }
        $('#AcceptCreateCustomerFromOpportunityModal').modal('show');
    }

    function drop() {
        var selectedRows = opportunities.rows({selected: true});
        if (selectedRows.count() > 0) {
            $("#deleting").html(selectedRows.data()[0].name ?? '');
        }
        $("#DeleteModal").modal('show');
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
            type: 'get',
            url: '{{ route('ajax.province.index') }}',
            data: {
                country_id: country_id
            },
            success: function (provinces) {
                provinceIdCreate.empty();
                provinceIdCreate.append(`<option value="">Seçim Yapılmadı</option>`);
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
            type: 'get',
            url: '{{ route('ajax.province.index') }}',
            data: {
                country_id: country_id
            },
            success: function (provinces) {
                provinceIdEdit.empty();
                provinceIdEdit.append(`<option value="">Seçim Yapılmadı</option>`);
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
            type: 'get',
            url: '{{ route('ajax.district.index') }}',
            data: {
                province_id: province_id
            },
            success: function (districts) {
                districtIdCreate.empty();
                districtIdCreate.append(`<option value="">Seçim Yapılmadı</option>`);
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
            type: 'get',
            url: '{{ route('ajax.district.index') }}',
            data: {
                province_id: province_id
            },
            success: function (districts) {
                districtIdEdit.empty();
                districtIdEdit.append(`<option value="">Seçim Yapılmadı</option>`);
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

    function getUsers(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.user.index') }}',
            data: {
                company_id: company_id
            },
            success: function (users) {
                userIdCreate.empty();
                userIdEdit.empty();
                userIdCreate.append(`<optgroup label=""><option value="" selected>Seçim Yok</optgroup>`);
                userIdEdit.append(`<optgroup label=""><option value="" selected>Seçim Yok</optgroup>`);
                $.each(users, function (index) {
                    userIdCreate.append(`<option value="${users[index].id}">${users[index].name}</option>`);
                    userIdEdit.append(`<option value="${users[index].id}">${users[index].name}</option>`);
                });
                userIdCreate.selectpicker('refresh');
                userIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getCustomers(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.customer.index') }}',
            data: {
                company_id: company_id
            },
            success: function (customers) {
                customerIdCreate.empty();
                customerIdEdit.empty();
                customerIdCreate.append(`<optgroup label=""><option value="" selected>Seçim Yok</optgroup>`);
                customerIdEdit.append(`<optgroup label=""><option value="" selected>Seçim Yok</optgroup>`);
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

    function getOpportunityPriorities(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.opportunityPriorities') }}',
            data: {
                company_id: company_id
            },
            success: function (priorities) {
                priorityIdCreate.empty();
                priorityIdEdit.empty();
                $.each(priorities, function (index) {
                    priorityIdCreate.append(`<option value="${priorities[index].id}">${priorities[index].name}</option>`);
                    priorityIdEdit.append(`<option value="${priorities[index].id}">${priorities[index].name}</option>`);
                });
                priorityIdCreate.selectpicker('refresh');
                priorityIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getOpportunityAccessTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.opportunityAccessTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (accessTypes) {
                accessTypeIdCreate.empty();
                accessTypeIdEdit.empty();
                $.each(accessTypes, function (index) {
                    accessTypeIdCreate.append(`<option value="${accessTypes[index].id}">${accessTypes[index].name}</option>`);
                    accessTypeIdEdit.append(`<option value="${accessTypes[index].id}">${accessTypes[index].name}</option>`);
                });
                accessTypeIdCreate.selectpicker('refresh');
                accessTypeIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getOpportunityEstimatedResultTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.opportunityEstimatedResultTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (estimatedResultTypes) {
                estimatedResultTypeIdCreate.empty();
                estimatedResultTypeIdEdit.empty();
                $.each(estimatedResultTypes, function (index) {
                    estimatedResultTypeIdCreate.append(`<option value="${estimatedResultTypes[index].id}">${estimatedResultTypes[index].name}</option>`);
                    estimatedResultTypeIdEdit.append(`<option value="${estimatedResultTypes[index].id}">${estimatedResultTypes[index].name}</option>`);
                });
                estimatedResultTypeIdCreate.selectpicker('refresh');
                estimatedResultTypeIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getOpportunityCapacityTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.opportunityCapacityTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (capacityTypes) {
                capacityTypeIdCreate.empty();
                capacityTypeIdEdit.empty();
                $.each(capacityTypes, function (index) {
                    capacityTypeIdCreate.append(`<option value="${capacityTypes[index].id}">${capacityTypes[index].name}</option>`);
                    capacityTypeIdEdit.append(`<option value="${capacityTypes[index].id}">${capacityTypes[index].name}</option>`);
                });
                capacityTypeIdCreate.selectpicker('refresh');
                capacityTypeIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getOpportunityStatuses(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.opportunityStatuses') }}',
            data: {
                company_id: company_id
            },
            success: function (statuses) {
                statusIdCreate.empty();
                statusIdEdit.empty();
                $.each(statuses, function (index) {
                    statusIdCreate.append(`<option value="${statuses[index].id}">${statuses[index].name}</option>`);
                    statusIdEdit.append(`<option value="${statuses[index].id}">${statuses[index].name}</option>`);
                });
                statusIdCreate.selectpicker('refresh');
                statusIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getBrands(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.brands') }}',
            data: {
                company_id: company_id
            },
            success: function (brands) {
                brandsCreate.empty();
                brandsEdit.empty();
                $.each(brands, function (index) {
                    brandsCreate.append(`<option value="${brands[index].id}">${brands[index].name}</option>`);
                    brandsEdit.append(`<option value="${brands[index].id}">${brands[index].name}</option>`);
                });
                brandsCreate.selectpicker('refresh');
                brandsEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getSectors(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.sectors') }}',
            data: {
                company_id: company_id
            },
            success: function (sectors) {
                sectorsCreate.empty();
                sectorsEdit.empty();
                $.each(sectors, function (index) {
                    sectorsCreate.append(`<option value="${sectors[index].id}">${sectors[index].name}</option>`);
                    sectorsEdit.append(`<option value="${sectors[index].id}">${sectors[index].name}</option>`);
                });
                sectorsCreate.selectpicker('refresh');
                sectorsEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

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
        getUsers($(this).val());
        getCustomers($(this).val());
        getOpportunityPriorities($(this).val());
        getOpportunityAccessTypes($(this).val());
        getOpportunityEstimatedResultTypes($(this).val());
        getOpportunityCapacityTypes($(this).val());
        getOpportunityStatuses($(this).val());
    });

    companyIdEdit.change(function () {
        getUsers($(this).val());
        getCustomers($(this).val());
        getOpportunityPriorities($(this).val());
        getOpportunityAccessTypes($(this).val());
        getOpportunityEstimatedResultTypes($(this).val());
        getOpportunityCapacityTypes($(this).val());
        getOpportunityStatuses($(this).val());
    });

    getUsers(SelectedCompany.val());
    getCountries();
    getUsers(SelectedCompany.val());
    getCustomers(SelectedCompany.val());
    getOpportunityPriorities(SelectedCompany.val());
    getOpportunityAccessTypes(SelectedCompany.val());
    getOpportunityEstimatedResultTypes(SelectedCompany.val());
    getOpportunityCapacityTypes(SelectedCompany.val());
    getOpportunityStatuses(SelectedCompany.val());
    getBrands(SelectedCompany.val());
    getSectors(SelectedCompany.val());

    SelectedCompany.change(function () {
        getUsers($(this).val());
        getCustomers(SelectedCompany.val());
        getOpportunityPriorities(SelectedCompany.val());
        getOpportunityAccessTypes(SelectedCompany.val());
        getOpportunityEstimatedResultTypes(SelectedCompany.val());
        getOpportunityCapacityTypes(SelectedCompany.val());
        getOpportunityStatuses(SelectedCompany.val());
        getBrands(SelectedCompany.val());
        getSectors(SelectedCompany.val());
        opportunities.ajax.reload().draw();
    });

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var user_id = $("#user_id_create").val();
        var company_id = $("#company_id_create").val();
        var customer_id = $("#customer_id_create").val();
        var name = $("#name_create").val();
        var email = $("#email_create").val();
        var identification_number = $("#identification_number_create").val();
        var phone_number = $("#phone_number_create").val();
        var manager_name = $("#manager_name_create").val();
        var manager_email = $("#manager_email_create").val();
        var manager_phone_number = $("#manager_phone_number_create").val();
        var website = $("#website_create").val();
        var description = $("#description_create").val();
        var date = $("#date_create").val();
        var price = $("#price_create").val();
        var currency = $("#currency_create").val();
        var priority_id = $("#priority_id_create").val();
        var access_type_id = $("#access_type_id_create").val();
        var domestic = $("#domestic_create").val();
        var country_id = $("#country_id_create").val();
        var province_id = $("#province_id_create").val();
        var district_id = $("#district_id_create").val();
        var foundation_date = $("#foundation_date_create").val();
        var estimated_result = $("#estimated_result_create").val();
        var estimated_result_type_id = $("#estimated_result_type_id_create").val();
        var capacity = $("#capacity_create").val();
        var capacity_type_id = $("#capacity_type_id_create").val();
        var status_id = $("#status_id_create").val();
        var brands = $("#brands_create").val();
        var sectors = $("#sectors_create").val();
        var calendar = $("#calendar_create").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else if (name == null || name === '') {
            toastr.warning('Müşteri Ünvanı Girilmesi Zorunludur!');
        } else if (province_id == null || province_id === '') {
            toastr.warning('Şehir Seçilmesi Zorunludur!');
        } else if (phone_number == null || phone_number === '') {
            toastr.warning('Telefon Girilmesi Zorunludur!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('ajax.opportunity.check') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    phone_number: phone_number,
                    email: email,
                    identification_number: identification_number
                },
                success: function (response) {
                    console.log(response)
                    if (response.redirection === 1) {
                        $('#redirect_id').val(response.opportunity.id);
                        $('#RedirectModal').modal('show');
                    } else {
                        saveOpportunity({
                            _token: '{{ csrf_token() }}',
                            auth_user_id: auth_user_id,
                            user_id: user_id,
                            company_id: company_id,
                            customer_id: customer_id,
                            name: name,
                            email: email,
                            identification_number: identification_number,
                            phone_number: phone_number,
                            manager_name: manager_name,
                            manager_email: manager_email,
                            manager_phone_number: manager_phone_number,
                            website: website,
                            description: description,
                            date: date,
                            price: price,
                            currency: currency,
                            priority_id: priority_id,
                            access_type_id: access_type_id,
                            domestic: domestic,
                            country_id: country_id,
                            province_id: province_id,
                            district_id: district_id,
                            foundation_date: foundation_date,
                            estimated_result: estimated_result,
                            estimated_result_type_id: estimated_result_type_id,
                            capacity: capacity,
                            capacity_type_id: capacity_type_id,
                            status_id: status_id,
                            brands: brands,
                            sectors: sectors,
                            calendar: calendar,
                        }, 'Yeni Fırsat Başarıyla Oluşturuldu', 'Fırsat Oluşturulurken Bir Hata Oluştu!', 0);
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Kontroller Sağlanırken Sistemsel Bir Sorun Oluştu!');
                }
            });
        }
    });

    RedirectButton.click(function () {
        $('#RedirectModal').modal('hide');
        var id = $("#redirect_id").val();
        window.open('{{ route('opportunity.show') }}/' + id + '/activity', '_self');
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var user_id = $("#user_id_edit").val();
        var company_id = $("#company_id_edit").val();
        var customer_id = $("#customer_id_edit").val();
        var name = $("#name_edit").val();
        var email = $("#email_edit").val();
        var identification_number = $("#identification_number_edit").val();
        var phone_number = $("#phone_number_edit").val();
        var manager_name = $("#manager_name_edit").val();
        var manager_email = $("#manager_email_edit").val();
        var manager_phone_number = $("#manager_phone_number_edit").val();
        var website = $("#website_edit").val();
        var description = $("#description_edit").val();
        var date = $("#date_edit").val();
        var price = $("#price_edit").val();
        var currency = $("#currency_edit").val();
        var priority_id = $("#priority_id_edit").val();
        var access_type_id = $("#access_type_id_edit").val();
        var domestic = $("#domestic_edit").val();
        var country_id = $("#country_id_edit").val();
        var province_id = $("#province_id_edit").val();
        var district_id = $("#district_id_edit").val();
        var foundation_date = $("#foundation_date_edit").val();
        var estimated_result = $("#estimated_result_edit").val();
        var estimated_result_type_id = $("#estimated_result_type_id_edit").val();
        var capacity = $("#capacity_edit").val();
        var capacity_type_id = $("#capacity_type_id_edit").val();
        var status_id = $("#status_id_edit").val();
        var brands = $("#brands_edit").val();
        var sectors = $("#sectors_edit").val();
        var calendar = $("#calendar_edit").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else if (name == null || name === '') {
            toastr.warning('Müşteri Ünvanı Girilmesi Zorunludur!');
        } else if (province_id == null || province_id === '') {
            toastr.warning('Şehir Seçilmesi Zorunludur!');
        } else if (phone_number == null || phone_number === '') {
            toastr.warning('Telefon Girilmesi Zorunludur!');
        } else {
            saveOpportunity({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                id: id,
                user_id: user_id,
                company_id: company_id,
                customer_id: customer_id,
                name: name,
                email: email,
                identification_number: identification_number,
                phone_number: phone_number,
                manager_name: manager_name,
                manager_email: manager_email,
                manager_phone_number: manager_phone_number,
                website: website,
                description: description,
                date: date,
                price: price,
                currency: currency,
                priority_id: priority_id,
                access_type_id: access_type_id,
                domestic: domestic,
                country_id: country_id,
                province_id: province_id,
                district_id: district_id,
                foundation_date: foundation_date,
                estimated_result: estimated_result,
                estimated_result_type_id: estimated_result_type_id,
                capacity: capacity,
                capacity_type_id: capacity_type_id,
                status_id: status_id,
                brands: brands,
                sectors: sectors,
                calendar: calendar,
            }, 'Fırsat Başarıyla Güncellendi', 'Fırsat Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    DeleteButton.click(function () {
        $("#DeleteModal").modal('hide');
        var id = $("#id_edit").val();
        $.ajax({
            type: 'delete',
            url: '{{ route('ajax.opportunity.drop') }}',
            data: {
                _token: '{{ csrf_token() }}',
                auth_user_id: '{{ auth()->user()->id() }}',
                id: id
            },
            success: function (response) {
                if (response.type === 'success') {
                    toastr.success(response.message);
                    opportunities.ajax.reload().draw();
                } else if (response.type === 'warning') {
                    toastr.warning(response.message);
                } else if (response.type === 'error') {
                    toastr.error(response.message);
                } else {
                    toastr.info(response.message);
                }
            },
            error: function (error) {
                console.log(error);
                toastr.error('Silinirken Sistemsel Bir Hata Oluştu!');
            }
        });
    });

    ImportExcelButton.click(function () {
        var data = new FormData();
        data.append('_token', '{{ csrf_token() }}');
        data.append('auth_user_id', '{{ auth()->user()->id() }}');
        data.append('excel', $('#excel_file')[0].files[0] ?? null);
        $.ajax({
            async: false,
            processData: false,
            contentType: false,
            type: 'post',
            url: '{{ route('ajax.opportunity.import') }}',
            data: data,
            success: function (response) {
                if (response.type === 'success') {
                    toastr.success(response.message);
                    $("#ImportExcelModal").modal('hide');
                    opportunities.ajax.reload().draw();
                } else if (response.type === 'warning') {
                    toastr.warning(response.message);
                } else if (response.type === 'error') {
                    toastr.error(response.message);
                } else {
                    toastr.info(response.message);
                }
            },
            error: function (error) {
                toastr.error('Dosya İçe Aktarılırken Bir Hata Oluştu!');
                console.log(error);
            }
        });
    });

    AcceptCreateCustomerFromOpportunityButton.click(function () {
        var id = $('#id_edit').val();
        var auth_user_id = '{{ auth()->user()->id() }}';

        $.ajax({
            type: 'post',
            url: '{{ route('ajax.opportunity.createCustomerFromOpportunity') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                auth_user_id: auth_user_id
            },
            success: function () {
                toastr.success('Fırsat Başarıyla Müşteriye Çevrildi');
                $('#AcceptCreateCustomerFromOpportunityModal').modal('hide');
                opportunities.ajax.reload();
            },
            error: function (error) {
                toastr.error('Fırsat Müşteriye Çevrilirken Sistemsel Bir Hata Oluştu!');
                console.log(error);
            }
        });
    });

    function saveOpportunity(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.opportunity.save') }}',
            data: data,
            success: function () {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#create_rightbar_toggle").click();
                } else if (direction === 1) {
                    $("#edit_rightbar_toggle").click();
                }
                var currentPage = opportunities.page.info().page;
                opportunities.ajax.reload().page(currentPage).draw('page');
            },
            error: function (error) {
                toastr.success(errorMessage);
                console.log(error)
            }
        });
    }

    BODY.on('contextmenu dblclick', function (e) {
        var selectedRows = opportunities.rows({selected: true});
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

    $('#opportunities tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            opportunities.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#opportunitiesCard").get(0), e.target)) {

        } else {
            $("#context-menu").hide();
            opportunities.rows().deselect();
        }
    });
</script>
