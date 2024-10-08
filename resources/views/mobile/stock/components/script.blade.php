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
    var unitTypeIdCreate = $("#unit_type_id_create");
    var typeIdCreate = $("#type_id_create");
    var statusIdCreate = $("#status_id_create");

    var companyIdEdit = $("#company_id_edit");
    var unitTypeIdEdit = $("#unit_type_id_edit");
    var typeIdEdit = $("#type_id_edit");
    var statusIdEdit = $("#status_id_edit");

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");

    var stocks = $('#stocks').DataTable({
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
            var r = $('#stocks tfoot tr');
            $('#stocks thead').append(r);
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
            url: '{{ route('ajax.stock.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val()
                });
            },
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'amount', name: 'amount'},
            {data: 'unit_type_id', name: 'unit_type_id'},
            {data: 'unit_price', name: 'unit_price'},
            {data: 'type_id', name: 'type_id'},
            {data: 'status_id', name: 'status_id'},
        ],

        responsive: true,
        stateSave: true,
        select: 'single'
    });

    stocks.on('select', function (e, dt, type, indexes) {
        var selectedRows = stocks.rows({selected: true});
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
        companyIdCreate.val(SelectedCompany.val()).selectpicker('refresh');
        getUnitTypes(SelectedCompany.val());
        getStockTypes(SelectedCompany.val());
        getStockStatuses(SelectedCompany.val());
        $("#CreateModal").modal('show');
    }

    function edit() {
        $("#EditModal").modal('show');

        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.stock.show') }}',
            data: {
                id: id
            },
            success: function (stock) {
                $("#company_id_edit").val(stock.company_id).selectpicker('refresh');
                $("#code_edit").val(stock.code);
                $("#name_edit").val(stock.name);
                $("#short_edit").val(stock.short);
                $("#wholesale_vat_edit").val(stock.wholesale_vat);
                $("#retail_vat_edit").val(stock.retail_vat);
                $("#unit_type_id_edit").val(stock.unit_type_id).selectpicker('refresh');
                $("#unit_price_edit").val(stock.unit_price);
                $("#currency_type_edit").val(stock.currency_type).selectpicker('refresh');
                $("#type_id_edit").val(stock.type_id).selectpicker('refresh');
                $("#status_id_edit").val(stock.status_id).selectpicker('refresh');
                $("#amount_edit").val(stock.amount);
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function drop() {

    }

    function getUnitTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.unitTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (unitTypes) {
                unitTypeIdCreate.empty();
                unitTypeIdEdit.empty();
                $.each(unitTypes, function (index) {
                    unitTypeIdCreate.append(`<option value="${unitTypes[index].id}">${unitTypes[index].name}</option>`);
                    unitTypeIdEdit.append(`<option value="${unitTypes[index].id}">${unitTypes[index].name}</option>`);
                });
                unitTypeIdCreate.selectpicker('refresh');
                unitTypeIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getStockTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.stockTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (stockTypes) {
                typeIdCreate.empty();
                typeIdEdit.empty();
                $.each(stockTypes, function (index) {
                    typeIdCreate.append(`<option value="${stockTypes[index].id}">${stockTypes[index].name}</option>`);
                    typeIdEdit.append(`<option value="${stockTypes[index].id}">${stockTypes[index].name}</option>`);
                });
                typeIdCreate.selectpicker('refresh');
                typeIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getStockStatuses(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.stockStatuses') }}',
            data: {
                company_id: company_id
            },
            success: function (stockStatuses) {
                statusIdCreate.empty();
                statusIdEdit.empty();
                $.each(stockStatuses, function (index) {
                    statusIdCreate.append(`<option value="${stockStatuses[index].id}">${stockStatuses[index].name}</option>`);
                    statusIdEdit.append(`<option value="${stockStatuses[index].id}">${stockStatuses[index].name}</option>`);
                });
                statusIdCreate.selectpicker('refresh');
                statusIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getUnitTypes(SelectedCompany.val());
    getStockTypes(SelectedCompany.val());
    getStockStatuses(SelectedCompany.val());

    SelectedCompany.change(function () {
        getUnitTypes(SelectedCompany.val());
        getStockTypes(SelectedCompany.val());
        getStockStatuses(SelectedCompany.val());
        stocks.ajax.reload().draw();
    });

    companyIdCreate.change(function () {
        getUnitTypes($(this).val());
        getStockTypes($(this).val());
        getStockStatuses($(this).val());
    });

    companyIdEdit.change(function () {
        getUnitTypes($(this).val());
        getStockTypes($(this).val());
        getStockStatuses($(this).val());
    });

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var company_id = $("#company_id_create").val();
        var code = $("#code_create").val();
        var name = $("#name_create").val();
        var short = $("#short_create").val();
        var wholesale_vat = $("#wholesale_vat_create").val();
        var retail_vat = $("#retail_vat_create").val();
        var unit_type_id = $("#unit_type_id_create").val();
        var unit_price = $("#unit_price_create").val();
        var currency_type = $("#currency_type_create").val();
        var type_id = $("#type_id_create").val();
        var status_id = $("#status_id_create").val();
        var amount = $("#amount_create").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else {
            saveStock({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                company_id: company_id,
                code: code,
                name: name,
                short: short,
                wholesale_vat: wholesale_vat,
                retail_vat: retail_vat,
                unit_type_id: unit_type_id,
                unit_price: unit_price,
                currency_type: currency_type,
                type_id: type_id,
                status_id: status_id,
                amount: amount,
            }, 'Yeni Stok Başarıyla Oluşturuldu', 'Stok Oluşturulurken Bir Hata Oluştu!', 0);
        }
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var company_id = $("#company_id_edit").val();
        var code = $("#code_edit").val();
        var name = $("#name_edit").val();
        var short = $("#short_edit").val();
        var wholesale_vat = $("#wholesale_vat_edit").val();
        var retail_vat = $("#retail_vat_edit").val();
        var unit_type_id = $("#unit_type_id_edit").val();
        var unit_price = $("#unit_price_edit").val();
        var currency_type = $("#currency_type_edit").val();
        var type_id = $("#type_id_edit").val();
        var status_id = $("#status_id_edit").val();
        var amount = $("#amount_edit").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else {
            saveStock({
                _token: '{{ csrf_token() }}',
                id: id,
                auth_user_id: auth_user_id,
                company_id: company_id,
                code: code,
                name: name,
                short: short,
                wholesale_vat: wholesale_vat,
                retail_vat: retail_vat,
                unit_type_id: unit_type_id,
                unit_price: unit_price,
                currency_type: currency_type,
                type_id: type_id,
                status_id: status_id,
                amount: amount,
            }, 'Müşteri Başarıyla Güncellendi', 'Müşteri Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    function saveStock(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.stock.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#CreateModal").modal('hide');
                } else if (direction === 1) {
                    $("#EditModal").modal('hide');
                }
                stocks.ajax.reload().draw();
            },
            error: function (error) {
                toastr.error(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = stocks.rows({selected: true});
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

    $('#stocks tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            stocks.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#stocksCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            stocks.rows().deselect();
        }
    });
</script>
