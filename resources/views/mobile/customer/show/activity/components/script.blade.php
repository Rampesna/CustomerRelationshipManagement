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

        dom: 'rtipl',

        order: [
            [
                0,
                "desc"
            ]
        ],

        initComplete: function () {
            var r = $('#activities tfoot tr');
            $('#activities thead').append(r);
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
            url: '{{ route('ajax.customer.activitiesDatatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    customer_id: '{{ $customer->id }}'
                });
            },
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'subject', name: 'subject'},
            {data: 'company_id', name: 'company_id'},
            {data: 'user_id', name: 'user_id'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'meet_reason_id', name: 'meet_reason_id'},
            {data: 'priority_id', name: 'priority_id'},
        ],

        responsive: true,
        stateSave: true,
        select: 'single'
    });

    activities.on('select', function (e, dt, type, indexes) {
        var selectedRows = activities.rows({selected: true});
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
        companyIdCreate.val({{ $customer->company_id }}).selectpicker('refresh');
        getUsers({{ $customer->company_id }});
        getActivityMeetingReasons({{ $customer->company_id }});
        getActivityPriorities({{ $customer->company_id }});
        userIdCreate.selectpicker('refresh');
        $("#CreateModal").modal('show');
    }

    function edit() {
        $("#EditModal").modal('show');

        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.activity.show') }}',
            data: {
                id: id
            },
            success: function (activity) {
                $("#company_id_edit").val(activity.company_id).selectpicker('refresh');
                getUsers(activity.company_id);
                $("#user_id_edit").val(activity.user_id).selectpicker('refresh');
                $("#relation_type_edit").val(activity.relation_type).selectpicker('refresh');
                $("#subject_edit").val(activity.subject);
                $("#start_date_edit").val(activity.start_date);
                $("#end_date_edit").val(activity.end_date);
                $("#meet_reason_id_edit").val(activity.meet_reason_id).selectpicker('refresh');
                $("#priority_id_edit").val(activity.priority_id).selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
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

    getUsers({{ $customer->company_id }});
    getActivityMeetingReasons({{ $customer->company_id }});
    getActivityPriorities({{ $customer->company_id }});

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
                priority_id: priority_id
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
                priority_id: priority_id
            }, 'Aktivite Başarıyla Güncellendi', 'Aktivite Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    function saveActivity(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.activity.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#CreateModal").modal('hide');
                } else if (direction === 1) {
                    $("#EditModal").modal('hide');
                }
                activities.ajax.reload().draw();
            },
            error: function (error) {
                toastr.error(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = activities.rows({selected: true});
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
