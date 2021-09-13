<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>
    var SelectedCompany = $("#SelectedCompany");

    var FilterButton = $("#FilterButton");
    var ClearFilterButton = $("#ClearFilterButton");

    var usersSelector = $('#users');

    function getUsers(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.user.all') }}',
            data: {
                company_id: company_id
            },
            success: function (users) {
                $.each(users, function (i, user) {
                    usersSelector.append(`<option value="${user.id}">${user.name}</option>`);
                });
                usersSelector.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getUsers();

    var targets = $('#targets').DataTable({
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
                        text: '<i class="fa fa-file-pdf"></i> PDF İndir',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 9, 10, 12, 20 ]
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> Excel İndir',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 9, 10, 12, 20 ]
                        }
                    }
                ]
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Yazdır',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 9, 10, 12, 20 ]
                }
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
                }
            }
        ],

        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "Tümü"]
        ],

        initComplete: function () {
            var r = $('#targets tfoot tr');
            $('#targets thead').append(r);
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
            url: '{{ route('ajax.user.target.reportDatatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    users: usersSelector.val() ?? [],
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                });
            },
            error: function (error) {
                console.log(error)
            }
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'opportunity_target', name: 'opportunity_target'},
            {data: 'activity_target', name: 'activity_target'},
        ],

        responsive: true,
    });

    $(document).delegate('.filterer', 'keydown', function (e) {
        if (e.keyCode === 13) {
            targets.ajax.reload().draw();
        }
    });

    FilterButton.click(function () {
        targets.ajax.reload().draw();
    });

    ClearFilterButton.click(function () {
        $("#users").val([]);
        $("#start_date").val('');
        $("#end_date").val('');
        targets.ajax.reload().draw();
    });
</script>
