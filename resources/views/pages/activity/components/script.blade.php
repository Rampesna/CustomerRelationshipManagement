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
    var priorityIdCreate = $("#priority_id_create");
    var meetingReasonIdCreate = $("#meet_reason_id_create");

    var companyIdEdit = $("#company_id_edit");
    var userIdEdit = $("#user_id_edit");
    var relationTypeEdit = $("#relation_type_edit");
    var relationIdEdit = $("#relation_id_edit");
    var priorityIdEdit = $("#priority_id_edit");
    var meetingReasonIdEdit = $("#meet_reason_id_edit");

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");
    var DeleteButton = $("#DeleteButton");

    var activities = $('#activities').DataTable({
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
                    activities.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#activities tfoot tr');
            $('#activities thead').append(r);
            this.api().columns().every(function (index) {
                var column = this;
                var input = document.createElement('input');
                if (index === 1) {
                    input = document.createElement('select');
                    var option = document.createElement("option");
                    option.setAttribute("value", "All");
                    option.innerHTML = "Tümü";
                    input.appendChild(option);

                    option = document.createElement("option");
                    option.setAttribute("value", "App\\Models\\Opportunity");
                    option.innerHTML = "Fırsat";
                    input.appendChild(option);

                    option = document.createElement("option");
                    option.setAttribute("value", "App\\Models\\Customer");
                    option.innerHTML = "Müşteri";
                    input.appendChild(option);
                } else if (index === 6) {
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
            url: '{{ route('ajax.activity.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val()
                });
            },
        },
        columns: [
            {data: 'id', name: 'id', width: '5%'},
            {data: 'relation_type', name: 'relation_type'},
            {data: 'relation_id', name: 'relation_id'},
            {data: 'subject', name: 'subject'},
            {data: 'company_id', name: 'company_id'},
            {data: 'user_id', name: 'user_id'},
            {data: 'start_date', name: 'start_date'},
            {data: 'province_id', name: 'province_id', orderable: false},
            {data: 'meet_reason_id', name: 'meet_reason_id'},
            {data: 'priority_id', name: 'priority_id'},
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

    function create() {
        $("#CreateForm").trigger('reset');
        companyIdCreate.val(SelectedCompany.val()).selectpicker('refresh');
        getUsers(SelectedCompany.val());
        getRelationsCreate(SelectedCompany.val());
        getRelationsEdit(SelectedCompany.val());
        getActivityMeetingReasons(SelectedCompany.val());
        getActivityPriorities(SelectedCompany.val());
        userIdCreate.selectpicker('refresh');
        $("#calendar_create").selectpicker('refresh');
        $("#create_rightbar_toggle").trigger('click');
    }

    function edit() {
        $("#edit_rightbar_toggle").trigger('click');
        $("#EditRightbar").hide();

        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.activity.show') }}',
            data: {
                id: id
            },
            success: function (activity) {
                if (activity.created_by == '{{ auth()->user()->id() }}' || {{ auth()->user()->authority(65) ? 1 : 0 }}) {
                    $("#company_id_edit").val(activity.company_id).selectpicker('refresh');
                    getUsers(activity.company_id);
                    $("#user_id_edit").val(activity.user_id).selectpicker('refresh');
                    $("#relation_type_edit").val(activity.relation_type).selectpicker('refresh');
                    getRelationsEdit(activity.relation_id, companyIdEdit.val());
                    $("#subject_edit").val(activity.subject);
                    $("#start_date_edit").val(activity.start_date);
                    $("#end_date_edit").val(activity.end_date);
                    $("#meet_reason_id_edit").val(activity.meet_reason_id).selectpicker('refresh');
                    $("#priority_id_edit").val(activity.priority_id).selectpicker('refresh');
                    $("#description_edit").val(activity.description);
                    $("#calendar_edit").val(activity.calendar).selectpicker('refresh');
                    $("#EditRightbar").fadeIn(250);
                } else {
                    toastr.warning('Başka Kullanıcılara Ait Aktiviteleri Düzenleme Yetkiniz Bulunmuyor!');
                    $("#edit_rightbar_toggle").trigger('click');
                }
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function show() {
        var id = $("#id_edit").val();
        window.open('{{ route('activity.show') }}/' + id + '/index', '_blank');
    }

    function drop() {
        var selectedRows = activities.rows({selected: true});
        if (selectedRows.count() > 0) {
            $("#deleting").html(selectedRows.data()[0].subject ?? '');
        }
        $("#DeleteModal").modal('show');
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
                        relationIdCreate.append(`<option value="${opportunities[index].id}">${opportunities[index].name ?? ''} - (${opportunities[index].province ? opportunities[index].province.name : ''})</option>`);
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
                        relationIdCreate.append(`<option value="${customers[index].id}">${customers[index].title ?? ''} - (${customers[index].province ? customers[index].province.name : ''})</option>`);
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
                        relationIdEdit.append(`<option ${id && id === opportunities[index].id ? 'selected' : null} value="${opportunities[index].id}">${opportunities[index].name ?? ''} - (${opportunities[index].province ? opportunities[index].province.name : ''})</option>`);
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
                        relationIdEdit.append(`<option ${id && id === customers[index].id ? 'selected' : null} value="${customers[index].id}">${customers[index].title ?? ''} - (${customers[index].province ? customers[index].province.name : ''})</option>`);
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

    function getActivityMeetingReasons(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.activityMeetingReasons') }}',
            data: {
                company_id: company_id
            },
            success: function (meetingReasons) {
                meetingReasonIdCreate.empty();
                meetingReasonIdEdit.empty();
                $.each(meetingReasons, function (index) {
                    meetingReasonIdCreate.append(`<option value="${meetingReasons[index].id}">${meetingReasons[index].name}</option>`);
                    meetingReasonIdEdit.append(`<option value="${meetingReasons[index].id}">${meetingReasons[index].name}</option>`);
                });
                meetingReasonIdCreate.selectpicker('refresh');
                meetingReasonIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getActivityPriorities(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.activityPriorities') }}',
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

    getUsers(SelectedCompany.val());
    getRelationsCreate(SelectedCompany.val());
    getRelationsEdit(SelectedCompany.val());
    getActivityMeetingReasons(SelectedCompany.val());
    getActivityPriorities(SelectedCompany.val());

    SelectedCompany.change(function () {
        getUsers($(this).val());
        getRelationsCreate($(this).val());
        getRelationsEdit(SelectedCompany.val());
        getActivityMeetingReasons(SelectedCompany.val());
        getActivityPriorities(SelectedCompany.val());
        activities.ajax.reload().draw();
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
        getActivityMeetingReasons($(this).val());
        getActivityPriorities($(this).val());
    });

    companyIdEdit.change(function () {
        getUsers($(this).val());
        getRelationsEdit(null, $(this).val());
        getActivityMeetingReasons($(this).val());
        getActivityPriorities($(this).val());
    });

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var user_id = $("#user_id_create").val();
        var company_id = $("#company_id_create").val();
        var relation_id = $("#relation_id_create").val();
        var relation_type = $("#relation_type_create").val();
        var subject = $("#subject_create").val();
        var notes = $("#notes_create").val();
        var start_date = $("#start_date_create").val();
        var end_date = $("#end_date_create").val();
        var meet_reason_id = $("#meet_reason_id_create").val();
        var priority_id = $("#priority_id_create").val();
        var description = $("#description_create").val();
        var calendar = $("#calendar_create").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else if (relation_type == null || relation_type === '' || relation_id == null || relation_id === '') {
            toastr.warning('Bağlantı Türü ve Bağantı Seçimi Zorunludur!');
        } else {
            saveActivity({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                user_id: user_id,
                company_id: company_id,
                relation_id: relation_id,
                relation_type: relation_type,
                subject: subject,
                notes: notes,
                start_date: start_date,
                end_date: end_date,
                meet_reason_id: meet_reason_id,
                priority_id: priority_id,
                description: description,
                calendar: calendar,
            }, 'Yeni Aktivite Başarıyla Oluşturuldu', 'Aktivite Oluşturulurken Bir Hata Oluştu!', 0);
        }
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var user_id = $("#user_id_edit").val();
        var company_id = $("#company_id_edit").val();
        var relation_id = $("#relation_id_edit").val();
        var relation_type = $("#relation_type_edit").val();
        var subject = $("#subject_edit").val();
        var notes = $("#notes_edit").val();
        var start_date = $("#start_date_edit").val();
        var end_date = $("#end_date_edit").val();
        var meet_reason_id = $("#meet_reason_id_edit").val();
        var priority_id = $("#priority_id_edit").val();
        var description = $("#description_edit").val();
        var calendar = $("#calendar_edit").val();

        if (id == null || id === '') {
            toastr.error('Aktivite Seçiminde Sistemsel Bir Hata Oluştu!');
        } else if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else if (relation_type == null || relation_type === '' || relation_id == null || relation_id === '') {
            toastr.warning('Bağlantı Türü ve Bağantı Seçimi Zorunludur!');
        } else {
            saveActivity({
                _token: '{{ csrf_token() }}',
                id: id,
                auth_user_id: auth_user_id,
                user_id: user_id,
                company_id: company_id,
                relation_id: relation_id,
                relation_type: relation_type,
                subject: subject,
                notes: notes,
                start_date: start_date,
                end_date: end_date,
                meet_reason_id: meet_reason_id,
                priority_id: priority_id,
                description: description,
                calendar: calendar,
            }, 'Aktivite Başarıyla Güncellendi', 'Aktivite Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    DeleteButton.click(function () {
        $("#DeleteModal").modal('hide');
        var id = $("#id_edit").val();
        $.ajax({
            type: 'delete',
            url: '{{ route('ajax.activity.drop') }}',
            data: {
                _token: '{{ csrf_token() }}',
                auth_user_id: '{{ auth()->user()->id() }}',
                id: id,
            },
            success: function (response) {
                if (response.type === 'success') {
                    toastr.success(response.message);
                    activities.ajax.reload().draw();
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

    function saveActivity(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.activity.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#create_rightbar_toggle").click();
                } else if (direction === 1) {
                    $("#edit_rightbar_toggle").click();
                }
                var currentPage = activities.page.info().page;
                activities.ajax.reload().page(currentPage).draw('page');
            },
            error: function (error) {
                toastr.success(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = activities.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id.replace('#', '');
            $("#id_edit").val(id);
            $("#deleting").html(selectedRows.data()[0].subject ?? '');
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

    $('#activities tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            activities.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#activitiesCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            activities.rows().deselect();
        }
    });
</script>
