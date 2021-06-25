<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>
    var SelectedCompany = $("#SelectedCompany");

    var FilterButton = $("#FilterButton");
    var ClearFilterButton = $("#ClearFilterButton");

    var payTypesSelector = $("#pay_types");
    var deliveryTypesSelector = $("#delivery_types");
    var statusesSelector = $("#statuses");

    function getPayTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.offerPayTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (payTypes) {
                payTypesSelector.empty();
                $.each(payTypes, function (index) {
                    payTypesSelector.append(`<option value="${payTypes[index].id}">${payTypes[index].name}</option>`);
                });
                payTypesSelector.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getDeliveryTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.offerDeliveryTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (deliveryTypes) {
                deliveryTypesSelector.empty();
                $.each(deliveryTypes, function (index) {
                    deliveryTypesSelector.append(`<option value="${deliveryTypes[index].id}">${deliveryTypes[index].name}</option>`);
                });
                deliveryTypesSelector.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getOfferStatuses(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.offerStatuses') }}',
            data: {
                company_id: company_id
            },
            success: function (offerStatuses) {
                statusesSelector.empty();
                $.each(offerStatuses, function (index) {
                    statusesSelector.append(`<option value="${offerStatuses[index].id}">${offerStatuses[index].name}</option>`);
                });
                statusesSelector.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getPayTypes(SelectedCompany.val());
    getDeliveryTypes(SelectedCompany.val());
    getOfferStatuses(SelectedCompany.val());

    var offers = $('#offers').DataTable({
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
                    offers.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "Tümü"]
        ],

        initComplete: function () {
            var r = $('#offers tfoot tr');
            $('#offers thead').append(r);
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
            url: '{{ route('ajax.offer.reportDatatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val(),
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                    subject: $("#subject_filterer").val(),
                    pay_types: $("#pay_types").val(),
                    delivery_types: $("#delivery_types").val(),
                    statuses: $("#statuses").val(),
                });
            },
        },
        columns: [
            {data: 'id', name: 'id', width: '3%'},
            {data: 'user_id', name: 'user_id'},
            {data: 'company_id', name: 'company_id'},
            {data: 'relation_type', name: 'relation_type'},
            {data: 'relation_id', name: 'relation_id'},
            {data: 'subject', name: 'subject'},
            {data: 'expiry_date', name: 'expiry_date'},
            {data: 'pay_type_id', name: 'pay_type_id'},
            {data: 'delivery_type_id', name: 'delivery_type_id'},
            {data: 'currency_type', name: 'currency_type'},
            {data: 'currency', name: 'currency'},
            {data: 'status_id', name: 'status_id'},
            {data: 'description', name: 'description'},
        ],

        responsive: true,
        stateSave: true,
        colReorder: true,
        select: true
    });

    $(document).delegate('.filterer', 'keydown', function (e) {
        if (e.keyCode === 13) {
            offers.ajax.reload().draw();
        }
    });

    FilterButton.click(function () {
        offers.ajax.reload().draw();
    });

    ClearFilterButton.click(function () {
        $("#start_date").val('');
        $("#end_date").val('');
        $("#subject_filterer").val('');
        $("#pay_types").val([]).selectpicker('refresh');
        $("#delivery_types").val([]).selectpicker('refresh');
        $("#statuses").val([]).selectpicker('refresh');
        offers.ajax.reload().draw();
    });

    SelectedCompany.change(function () {
        offers.ajax.reload().draw();
        getPayTypes(SelectedCompany.val());
        getDeliveryTypes(SelectedCompany.val());
        getOfferStatuses(SelectedCompany.val());
    });
</script>
