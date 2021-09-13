<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>
    var SelectedCompany = $("#SelectedCompany");

    var FilterButton = $("#FilterButton");
    var ClearFilterButton = $("#ClearFilterButton");

    var statusesSelector = $("#statuses");
    var cargoCompaniesSelector = $("#cargo_companies");

    var allCompanies = $('#all_companies');

    function getSampleStatuses(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.sampleStatuses') }}',
            data: {
                company_id: company_id
            },
            success: function (sampleStatuses) {
                statusesSelector.empty();
                $.each(sampleStatuses, function (index) {
                    statusesSelector.append(`<option value="${sampleStatuses[index].id}">${sampleStatuses[index].name}</option>`);
                });
                statusesSelector.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getCargoCompanies(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.cargoCompanies') }}',
            data: {
                company_id: company_id
            },
            success: function (cargoCompanies) {
                cargoCompaniesSelector.empty();
                $.each(cargoCompanies, function (index) {
                    cargoCompaniesSelector.append(`<option value="${cargoCompanies[index].id}">${cargoCompanies[index].name}</option>`);
                });
                cargoCompaniesSelector.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getSampleStatuses(SelectedCompany.val());
    getCargoCompanies(SelectedCompany.val());

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
                    samples.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "Tümü"]
        ],

        initComplete: function () {
            var r = $('#samples tfoot tr');
            $('#samples thead').append(r);
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
            url: '{{ route('ajax.sample.reportDatatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    all_companies: allCompanies.val(),
                    company_id: SelectedCompany.val(),
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                    subject: $("#subject_filterer").val(),
                    statuses: $("#statuses").val(),
                    cargo_companies: $("#cargo_companies").val(),
                });
            },
        },
        columns: [
            {data: 'id', name: 'id', width: '3%'},
            {data: 'user_id', name: 'user_id'},
            {data: 'company_id', name: 'company_id'},
            {data: 'relation_type', name: 'relation_type'},
            {data: 'relation_id', name: 'relation_id'},
            {data: 'date', name: 'date'},
            {data: 'status_id', name: 'status_id'},
            {data: 'subject', name: 'subject'},
            {data: 'cargo_company_id', name: 'cargo_company_id'},
            {data: 'cargo_tracking_number', name: 'cargo_tracking_number'},
            {data: 'bus_company', name: 'bus_company'},
            {data: 'car_plate', name: 'car_plate'},
        ],

        responsive: true,
        stateSave: true,
        colReorder: true,
        select: true
    });

    $(document).delegate('.filterer', 'keydown', function (e) {
        if (e.keyCode === 13) {
            samples.ajax.reload().draw();
        }
    });

    FilterButton.click(function () {
        samples.ajax.reload().draw();
    });

    ClearFilterButton.click(function () {
        $("#start_date").val('');
        $("#end_date").val('');
        $("#subject_filterer").val('');
        $("#statuses").val([]).selectpicker('refresh');
        $("#cargo_companies").val([]).selectpicker('refresh');
        samples.ajax.reload().draw();
    });

    SelectedCompany.change(function () {
        samples.ajax.reload().draw();
        getActivityMeetReasons(SelectedCompany.val());
        getActivityPriorities(SelectedCompany.val());
    });
</script>
