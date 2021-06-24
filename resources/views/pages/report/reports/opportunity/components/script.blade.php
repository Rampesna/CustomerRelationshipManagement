<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>
    var SelectedCompany = $("#SelectedCompany");

    var FilterButton = $("#FilterButton");
    var ClearFilterButton = $("#ClearFilterButton");

    var countriesSelector = $("#countries");
    var provincesSelector = $("#provinces");

    function getCountries() {
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('ajax.country.index') }}',
            data: {},
            success: function (countries) {
                countriesSelector.empty();
                $.each(countries, function (index) {
                    countriesSelector.append(`<option ${countries[index].short === 'TR' && countries[index].code === '90' ? 'selected' : null} value="${countries[index].id}">${countries[index].name} (+${countries[index].code})</option>`);
                });
                countriesSelector.selectpicker('refresh');
                getProvinces();
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getProvinces() {
        var countries = countriesSelector.val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.province.index') }}',
            data: {
                countries: countries
            },
            success: function (provinces) {
                provincesSelector.empty();
                $.each(provinces, function (index) {
                    provincesSelector.append(`<option value="${provinces[index].id}">${provinces[index].name}</option>`);
                });
                provincesSelector.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getCountries();

    countriesSelector.change(function () {
        getProvinces();
    });

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
            url: '{{ route('ajax.opportunity.reportDatatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val(),
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                    name: $("#name_filterer").val(),
                    email: $("#email_filterer").val(),
                    phone_number: $("#phone_number_filterer").val(),
                    website: $("#website_filterer").val(),
                    countries: $("#countries").val(),
                    provinces: $("#provinces").val(),
                    priorities: $("#priorities").val(),
                    access_types: $("#access_types").val(),
                    min_capacity: $("#min_capacity").val(),
                    max_capacity: $("#max_capacity").val(),
                    capacity_types: $("#capacity_types").val(),
                });
            },
        },
        columns: [
            {data: 'id', name: 'id', width: '3%'},
            {data: 'user_id', name: 'user_id'},
            {data: 'company_id', name: 'company_id'},
            {data: 'customer_id', name: 'customer_id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'manager_name', name: 'manager_name'},
            {data: 'manager_email', name: 'manager_email'},
            {data: 'manager_phone_number', name: 'manager_phone_number'},
            {data: 'website', name: 'website'},
            {data: 'date', name: 'date'},
            {data: 'price', name: 'price'},
            {data: 'currency', name: 'currency'},
            {data: 'priority_id', name: 'priority_id'},
            {data: 'access_type_id', name: 'access_type_id'},
            {data: 'domestic', name: 'domestic'},
            {data: 'country_id', name: 'country_id'},
            {data: 'province_id', name: 'province_id'},
            {data: 'district_id', name: 'district_id'},
            {data: 'foundation_date', name: 'foundation_date'},
            {data: 'estimated_result', name: 'estimated_result'},
            {data: 'estimated_result_type_id', name: 'estimated_result_type_id'},
            {data: 'capacity', name: 'capacity'},
            {data: 'capacity_type_id', name: 'capacity_type_id'},
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
            opportunities.ajax.reload().draw();
        }
    });

    FilterButton.click(function () {
        opportunities.ajax.reload().draw();
    });

    ClearFilterButton.click(function () {
        $("#start_date").val('');
        $("#end_date").val('');
        $("#name_filterer").val('');
        $("#email_filterer").val('');
        $("#phone_number_filterer").val('');
        $("#website_filterer").val('');
        $("#countries").val([]).selectpicker('refresh');
        $("#provinces").val([]).selectpicker('refresh');
        $("#priorities").val([]).selectpicker('refresh');
        $("#access_types").val('').selectpicker('refresh');
        $("#min_capacity").val('');
        $("#max_capacity").val('');
        $("#capacity_types").val('').selectpicker('refresh');
        getProvinces();
        opportunities.ajax.reload().draw();
    });
</script>
