<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>
    var SelectedCompany = $("#SelectedCompany");

    var FilterButton = $("#FilterButton");
    var ClearFilterButton = $("#ClearFilterButton");

    var meetingReasonsSelector = $("#meet_reasons");
    var prioritiesSelector = $("#priorities");

    function getActivityMeetReasons(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.activityMeetingReasons') }}',
            data: {
                company_id: company_id
            },
            success: function (meetReasons) {
                meetingReasonsSelector.empty();
                $.each(meetReasons, function (index) {
                    meetingReasonsSelector.append(`<option value="${meetReasons[index].id}">${meetReasons[index].name}</option>`);
                });
                meetingReasonsSelector.selectpicker('refresh');
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
                prioritiesSelector.empty();
                $.each(priorities, function (index) {
                    prioritiesSelector.append(`<option value="${priorities[index].id}">${priorities[index].name}</option>`);
                });
                prioritiesSelector.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getActivityMeetReasons(SelectedCompany.val());
    getActivityPriorities(SelectedCompany.val());

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

        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "Tümü"]
        ],

        initComplete: function () {
            var r = $('#activities tfoot tr');
            $('#activities thead').append(r);
            this.api().columns().every(function (index) {
                var column = this;
                var input = document.createElement('input');

                if (index === 3) {
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
            url: '{{ route('ajax.activity.reportDatatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val(),
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                    subject: $("#subject_filterer").val(),
                    meet_reasons: $("#meet_reasons").val(),
                    priorities: $("#priorities").val(),
                });
            },
        },
        columns: [
            {data: 'id', name: 'id', width: '3%'},
            {data: 'company_id', name: 'company_id'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'relation_type', name: 'relation_type'},
            {data: 'relation_id', name: 'relation_id'},
            {data: 'user_id', name: 'user_id'},
            {data: 'subject', name: 'subject'},
            {data: 'meet_reason_id', name: 'meet_reason_id'},
            {data: 'priority_id', name: 'priority_id'},
            {data: 'description', name: 'description'},
        ],

        responsive: true,
        stateSave: true,
        colReorder: true,
        select: true
    });

    $(document).delegate('.filterer', 'keydown', function (e) {
        if (e.keyCode === 13) {
            activities.ajax.reload().draw();
        }
    });

    FilterButton.click(function () {
        activities.ajax.reload().draw();
    });

    ClearFilterButton.click(function () {
        $("#start_date").val('');
        $("#end_date").val('');
        $("#subject_filterer").val('');
        $("#meet_reasons").val([]).selectpicker('refresh');
        $("#priorities").val([]).selectpicker('refresh');
        activities.ajax.reload().draw();
    });

    SelectedCompany.change(function () {
        activities.ajax.reload().draw();
        getActivityMeetReasons(SelectedCompany.val());
        getActivityPriorities(SelectedCompany.val());
    });
</script>
