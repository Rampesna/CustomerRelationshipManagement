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
    var userIdCreate = $("#user_id_create");
    var relationTypeCreate = $("#relation_type_create");
    var relationIdCreate = $("#relation_id_create");
    var cargoCompanyIdCreate = $("#cargo_company_id_create");
    var statusIdCreate = $("#status_id_create");

    var companyIdEdit = $("#company_id_edit");
    var userIdEdit = $("#user_id_edit");
    var relationTypeEdit = $("#relation_type_edit");
    var relationIdEdit = $("#relation_id_edit");
    var cargoCompanyIdEdit = $("#cargo_company_id_edit");
    var statusIdEdit = $("#status_id_edit");

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");

    var samples = $('#samples').DataTable({
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
            var r = $('#samples tfoot tr');
            $('#samples thead').append(r);
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
            url: '{{ route('ajax.sample.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val()
                });
            },
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'subject', name: 'subject'},
            {data: 'relation_type', name: 'relation_type'},
            {data: 'relation_id', name: 'relation_id'},
            {data: 'date', name: 'date'},
            {data: 'status_id', name: 'status_id'},
            {data: 'company_id', name: 'company_id'},
            {data: 'user_id', name: 'user_id'},
        ],

        responsive: true,
        stateSave: true,
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

    function create() {
        $("#CreateForm").trigger('reset');
        companyIdCreate.val(SelectedCompany.val()).selectpicker('refresh');
        userIdCreate.selectpicker('refresh');
        relationTypeCreate.selectpicker('refresh');
        relationIdCreate.selectpicker('refresh');
        statusIdCreate.selectpicker('refresh');
        cargoCompanyIdCreate.selectpicker('refresh');
        $("#create_rightbar_toggle").trigger('click');
    }

    function edit() {
        $("#edit_rightbar_toggle").trigger('click');
        $("#EditRightbar").hide();

        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.sample.show') }}',
            data: {
                id: id
            },
            success: function (sample) {
                $("#company_id_edit").val(sample.company_id).selectpicker('refresh');
                getUsers(companyIdEdit.val());
                $("#user_id_edit").val(sample.user_id).selectpicker('refresh');
                relationTypeEdit.val(sample.relation_type).selectpicker('refresh');
                getRelationsEdit(sample.relation_id, companyIdEdit.val());
                $("#subject_edit").val(sample.subject);
                $("#date_edit").val(sample.date);
                $("#status_id_edit").val(sample.status_id).selectpicker('refresh');
                $("#cargo_company_id_edit").val(sample.cargo_company_id).selectpicker('refresh');
                $("#cargo_tracking_number_edit").val(sample.cargo_tracking_number);
                $("#bus_company_edit").val(sample.bus_company);
                $("#car_plate_edit").val(sample.car_plate);
                $("#EditRightbar").fadeIn(250);
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

    function drop() {

    }

    function getUsers(company_id) {
        $.ajax({
            async: false,
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

    function getRelationsCreate(company_id) {
        var relation_type = relationTypeCreate.val();

        if (relation_type === 'App\\Models\\Opportunity') {
            $.ajax({
                type: 'get',
                url: '{{ route('ajax.opportunity.index') }}',
                data: {
                    company_id: company_id
                },
                success: function (opportunities) {
                    relationIdCreate.empty();
                    $.each(opportunities, function (index) {
                        relationIdCreate.append(`<option value="${opportunities[index].id}">${opportunities[index].name ?? ''}</option>`);
                    });
                    relationIdCreate.selectpicker('refresh');
                },
                error: function (error) {
                    toastr.error('Fırsatlar Yüklenirken Bir Hata Oluştu');
                    console.log(error);
                }
            });
        } else if (relation_type === 'App\\Models\\Customer') {
            $.ajax({
                type: 'get',
                url: '{{ route('ajax.customer.index') }}',
                data: {
                    company_id: company_id
                },
                success: function (customers) {
                    relationIdCreate.empty();
                    $.each(customers, function (index) {
                        relationIdCreate.append(`<option value="${customers[index].id}">${customers[index].title ?? ''}</option>`);
                    });
                    relationIdCreate.selectpicker('refresh');
                },
                error: function (error) {
                    toastr.error('Müşteriler Yüklenirken Bir Hata Oluştu');
                    console.log(error);
                }
            });
        } else {
            toastr.warning('Bağlantı Türünde Bir Hata Var!');
        }
    }

    function getRelationsEdit(id, company_id) {
        var relation_type = relationTypeEdit.val();

        if (relation_type === 'App\\Models\\Opportunity') {
            $.ajax({
                type: 'get',
                url: '{{ route('ajax.opportunity.index') }}',
                data: {
                    company_id: company_id
                },
                success: function (opportunities) {
                    relationIdEdit.empty();
                    $.each(opportunities, function (index) {
                        relationIdEdit.append(`<option ${id && id === opportunities[index].id ? 'selected' : null} value="${opportunities[index].id}">${opportunities[index].name ?? ''}</option>`);
                    });
                    relationIdEdit.selectpicker('refresh');
                },
                error: function (error) {
                    toastr.error('Fırsatlar Yüklenirken Bir Hata Oluştu');
                    console.log(error);
                }
            });
        } else if (relation_type === 'App\\Models\\Customer') {
            $.ajax({
                type: 'get',
                url: '{{ route('ajax.customer.index') }}',
                data: {
                    company_id: company_id
                },
                success: function (customers) {
                    relationIdEdit.empty();
                    $.each(customers, function (index) {
                        relationIdEdit.append(`<option ${id && id === customers[index].id ? 'selected' : null} value="${customers[index].id}">${customers[index].title ?? ''}</option>`);
                    });
                    relationIdEdit.selectpicker('refresh');
                },
                error: function (error) {
                    toastr.error('Müşteriler Yüklenirken Bir Hata Oluştu');
                    console.log(error);
                }
            });
        } else {
            toastr.warning('Bağlantı Türünde Bir Hata Var!');
        }
    }

    function getCargoCompanies(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.cargoCompanies') }}',
            data: {
                company_id: company_id
            },
            success: function (cargoCompanies) {
                cargoCompanyIdCreate.empty();
                cargoCompanyIdEdit.empty();
                $.each(cargoCompanies, function (index) {
                    cargoCompanyIdCreate.append(`<option value="${cargoCompanies[index].id}">${cargoCompanies[index].name}</option>`);
                    cargoCompanyIdEdit.append(`<option value="${cargoCompanies[index].id}">${cargoCompanies[index].name}</option>`);
                });
                cargoCompanyIdCreate.selectpicker('refresh');
                cargoCompanyIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getSampleStatuses(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.sampleStatuses') }}',
            data: {
                company_id: company_id
            },
            success: function (sampleStatuses) {
                statusIdCreate.empty();
                statusIdEdit.empty();
                $.each(sampleStatuses, function (index) {
                    statusIdCreate.append(`<option value="${sampleStatuses[index].id}">${sampleStatuses[index].name}</option>`);
                    statusIdEdit.append(`<option value="${sampleStatuses[index].id}">${sampleStatuses[index].name}</option>`);
                });
                statusIdCreate.selectpicker('refresh');
                statusIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getUsers(SelectedCompany.val());
    getRelationsCreate(SelectedCompany.val());
    getRelationsEdit(null, SelectedCompany.val());
    getCargoCompanies(SelectedCompany.val());
    getSampleStatuses(SelectedCompany.val());

    SelectedCompany.change(function () {
        getUsers($(this).val());
        getRelationsCreate(SelectedCompany.val());
        getRelationsEdit(null, SelectedCompany.val());
        getCargoCompanies(SelectedCompany.val());
        getSampleStatuses(SelectedCompany.val());
        samples.ajax.reload().draw();
    });

    relationTypeCreate.change(function () {
        getRelationsCreate(companyIdCreate.val());
    });

    relationTypeEdit.change(function () {
        getRelationsEdit(null, companyIdEdit.val());
    });

    companyIdCreate.change(function () {
        getUsers($(this).val());
        getRelationsCreate($(this).val());
        getCargoCompanies($(this).val());
        getSampleStatuses($(this).val());
    });

    companyIdEdit.change(function () {
        getUsers($(this).val());
        getRelationsEdit(null ,$(this).val());
        getCargoCompanies($(this).val());
        getSampleStatuses($(this).val());
    });

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var user_id = $("#user_id_create").val();
        var company_id = $("#company_id_create").val();
        var relation_type = $("#relation_type_create").val();
        var relation_id = $("#relation_id_create").val();
        var subject = $("#subject_create").val();
        var date = $("#date_create").val();
        var status_id = $("#status_id_create").val();
        var cargo_company_id = $("#cargo_company_id_create").val();
        var cargo_tracking_number = $("#cargo_tracking_number_create").val();
        var bus_company = $("#bus_company_create").val();
        var car_plate = $("#car_plate_create").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else if (relation_type == null || relation_type === '' || relation_id == null || relation_id === '') {
            toastr.warning('Bağlantı Türü ve Bağlantı Seçimi Zorunludur!');
        } else {
            saveSample({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                user_id: user_id,
                company_id: company_id,
                relation_type: relation_type,
                relation_id: relation_id,
                subject: subject,
                date: date,
                status_id: status_id,
                cargo_company_id: cargo_company_id,
                cargo_tracking_number: cargo_tracking_number,
                bus_company: bus_company,
                car_plate: car_plate,
            }, 'Yeni Numune Başarıyla Oluşturuldu', 'Numune Oluşturulurken Bir Hata Oluştu!', 0);
        }
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var user_id = $("#user_id_edit").val();
        var company_id = $("#company_id_edit").val();
        var relation_type = $("#relation_type_edit").val();
        var relation_id = $("#relation_id_edit").val();
        var subject = $("#subject_edit").val();
        var date = $("#date_edit").val();
        var status_id = $("#status_id_edit").val();
        var cargo_company_id = $("#cargo_company_id_edit").val();
        var cargo_tracking_number = $("#cargo_tracking_number_edit").val();
        var bus_company = $("#bus_company_edit").val();
        var car_plate = $("#car_plate_edit").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else if (relation_type == null || relation_type === '' || relation_id == null || relation_id === '') {
            toastr.warning('Bağlantı Türü ve Bağlantı Seçimi Zorunludur!');
        } else {
            saveSample({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                id: id,
                user_id: user_id,
                company_id: company_id,
                relation_type: relation_type,
                relation_id: relation_id,
                subject: subject,
                date: date,
                status_id: status_id,
                cargo_company_id: cargo_company_id,
                cargo_tracking_number: cargo_tracking_number,
                bus_company: bus_company,
                car_plate: car_plate,
            }, 'Numune Başarıyla Güncellendi', 'Numune Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    function saveSample(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.sample.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#create_rightbar_toggle").click();
                } else if (direction === 1) {
                    $("#edit_rightbar_toggle").click();
                }
                samples.ajax.reload().draw();
                console.log(response)
            },
            error: function (error) {
                toastr.success(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = samples.rows({selected: true});
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

    $('#samples tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            samples.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#samplesCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            samples.rows().deselect();
        }
    });
</script>
