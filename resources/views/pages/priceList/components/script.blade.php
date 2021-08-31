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

    var CreatePriceListItemForm = $("#CreatePriceListItemForm");
    var CreatePriceListItemButton = $("#CreatePriceListItemButton");
    var UpdatePriceListItemButton = $("#UpdatePriceListItemButton");

    var priceListItemDeleteIcon = $("#priceListItemDeleteIcon");
    var priceListItemEditIcon = $("#priceListItemEditIcon");
    var priceListItemCreateIcon = $("#priceListItemCreateIcon");

    var companyIdCreate = $("#company_id_create");
    var userIdCreate = $("#user_id_create");
    var statusIdCreate = $("#status_id_create");

    var companyIdEdit = $("#company_id_edit");
    var userIdEdit = $("#user_id_edit");
    var statusIdEdit = $("#status_id_edit");

    var priceListItemStockIdCreate = $("#price_list_item_stock_id_create");
    var priceListItemStockIdEdit = $("#price_list_item_stock_id_edit");

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");
    var CopyButton = $("#CopyButton");
    var DeleteButton = $("#DeleteButton");
    var SendEmailButton = $("#SendEmailButton");

    var priceLists = $('#priceLists').DataTable({
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
                    priceLists.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#priceLists tfoot tr');
            $('#priceLists thead').append(r);
            this.api().columns().every(function (index) {
                var column = this;
                var input = document.createElement('input');

                if (index === 2 || index === 3) {
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
            url: '{{ route('ajax.priceList.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val()
                });
            },
        },
        columns: [
            {data: 'id', name: 'id', width: '5%'},
            {data: 'name', name: 'name'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'status_id', name: 'status_id'},
            {data: 'company_id', name: 'company_id'},
        ],

        responsive: true,
        stateSave: true,
        colReorder: true,
        select: 'single'
    });

    var priceListItems = $('#priceListItems').DataTable({
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

        processing: true,
        serverSide: true,
        ajax: {
            type: 'get',
            url: '{{ route('ajax.priceListItem.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    price_list_id: $("#id_edit").val()
                });
            }
        },
        columns: [
            {data: 'stock_id', name: 'stock_id'},
            {data: 'unit_price', name: 'unit_price'},
            {data: 'vat_rate', name: 'vat_rate'},
            {data: 'currency_type', name: 'currency_type'},
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
        getUsers(SelectedCompany.val());
        getPriceListStatuses(SelectedCompany.val());
        $("#create_rightbar_toggle").trigger('click');
    }

    function edit() {
        $("#edit_rightbar_toggle").trigger('click');
        $("#EditRightbar").hide();
        priceListItems.ajax.reload().draw();
        priceListItemDeleteIcon.hide();
        priceListItemEditIcon.hide();
        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.priceList.show') }}',
            data: {
                id: id
            },
            success: function (priceList) {
                $("#company_id_edit").val(priceList.company_id).selectpicker('refresh');
                getUsers(priceList.company_id);
                getPriceListStatuses(priceList.company_id);
                $("#user_id_edit").val(priceList.user_id).selectpicker('refresh');
                $("#name_edit").val(priceList.name);
                $("#status_id_edit").val(priceList.status_id).selectpicker('refresh');
                $("#start_date_edit").val(priceList.start_date);
                $("#end_date_edit").val(priceList.end_date);
                $("#description_edit").val(priceList.description);
                $("#EditRightbar").fadeIn(250);
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function copy() {
        $("#CopyForm").trigger('reset');
        $("#CopyModal").modal('show');
    }

    function drop() {
        var selectedRows = priceLists.rows({selected: true});
        if (selectedRows.count() > 0) {
            $("#deleting").html(selectedRows.data()[0].name ?? '');
        }
        $("#DeleteModal").modal('show');
    }

    function downloadPDF() {
        var id = $("#id_edit").val();
        toastr.info('Dosya Hazırlanıyor Lütfen Bekleyin...');
        window.location.href = '{{ route('ajax.priceList.downloadPDF') }}?id=' + id;
    }

    function sendEmailModal() {
        $("#SendEmailModal").modal('show');
        $("#send_email").val('');
    }

    SendEmailButton.click(function () {
        var id = $("#id_edit").val();
        var email = $("#send_email").val();
        $("#SendEmailModal").modal('hide');
        $("#loader").fadeIn(250);
        toastr.info('Mail Gönderiliyor...');
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.priceList.sendEmail') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                email: email
            },
            success: function () {
                toastr.success('Mail Başarıyla Gönderildi.');
                $("#loader").fadeOut(250);
            },
            error: function (error) {
                toastr.error('Mail Gönderilirken Sistemsel Bir Hata Oluştu!');
                console.log(error);
                $("#loader").fadeOut(250);
            }
        });
    });

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

    function getPriceListStatuses(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.priceListStatuses') }}',
            data: {
                company_id: company_id
            },
            success: function (priceListStatuses) {
                statusIdCreate.empty();
                statusIdEdit.empty();
                $.each(priceListStatuses, function (index) {
                    statusIdCreate.append(`<option value="${priceListStatuses[index].id}">${priceListStatuses[index].name}</option>`);
                    statusIdEdit.append(`<option value="${priceListStatuses[index].id}">${priceListStatuses[index].name}</option>`);
                });
                statusIdCreate.selectpicker('refresh');
                statusIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getStocks(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.stock.index') }}',
            data: {
                company_id: company_id
            },
            success: function (stocks) {
                priceListItemStockIdCreate.empty();
                priceListItemStockIdEdit.empty();
                priceListItemStockIdCreate.append(`<option value="" selected hidden disabled></option>`);
                $.each(stocks, function (index) {
                    priceListItemStockIdCreate.append(`<option value="${stocks[index].id}">${stocks[index].name}</option>`);
                    priceListItemStockIdEdit.append(`<option value="${stocks[index].id}">${stocks[index].name}</option>`);
                });
                priceListItemStockIdCreate.selectpicker('refresh');
                priceListItemStockIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getUsers(SelectedCompany.val());
    getStocks(SelectedCompany.val());
    getPriceListStatuses(SelectedCompany.val());

    SelectedCompany.change(function () {
        getUsers($(this).val());
        getStocks($(this).val());
        getPriceListStatuses($(this).val());
        priceLists.ajax.reload().draw();
    });

    companyIdCreate.change(function () {
        getUsers($(this).val());
        getPriceListStatuses($(this).val());
    });

    companyIdEdit.change(function () {
        getUsers($(this).val());
        getPriceListStatuses($(this).val());
    });

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var company_id = $("#company_id_create").val();
        var user_id = $("#user_id_create").val();
        var name = $("#name_create").val();
        var description = $("#description_create").val();
        var start_date = $("#start_date_create").val();
        var end_date = $("#end_date_create").val();
        var status_id = $("#status_id_create").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else {
            savePriceList({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                company_id: company_id,
                user_id: user_id,
                name: name,
                description: description,
                start_date: start_date,
                end_date: end_date,
                status_id: status_id,
            }, 'Yeni Fiyat Listesi Başarıyla Oluşturuldu', 'Fiyat Listesi Oluşturulurken Bir Hata Oluştu!', 0);
        }
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var company_id = $("#company_id_edit").val();
        var user_id = $("#user_id_edit").val();
        var name = $("#name_edit").val();
        var description = $("#description_edit").val();
        var start_date = $("#start_date_edit").val();
        var end_date = $("#end_date_edit").val();
        var status_id = $("#status_id_edit").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else {
            savePriceList({
                _token: '{{ csrf_token() }}',
                id: id,
                auth_user_id: auth_user_id,
                company_id: company_id,
                user_id: user_id,
                name: name,
                description: description,
                start_date: start_date,
                end_date: end_date,
                status_id: status_id,
            }, 'Fiyat Listesi Başarıyla Güncellendi', 'Fiyat Listesi Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    CopyButton.click(function () {
        $("#CopyModal").modal('hide');
        var old_id = $("#id_edit").val();
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.priceList.show') }}',
            data: {
                id: old_id
            },
            success: function (priceList) {
                var old_id = priceList.id;
                var auth_user_id = '{{ auth()->user()->id() }}';
                var company_id = priceList.company_id;
                var user_id = priceList.user_id;
                var name = $("#name_copy").val();
                var description = priceList.description;
                var start_date = priceList.start_date;
                var end_date = priceList.end_date;
                var status_id = priceList.status_id;

                if (name == null || name === '') {
                    toastr.warning('Yeni Fiyat Listesinin Adı Boş Olamaz!');
                } else {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('ajax.priceList.copy') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            old_id: old_id,
                            auth_user_id: auth_user_id,
                            company_id: company_id,
                            user_id: user_id,
                            name: name,
                            description: description,
                            start_date: start_date,
                            end_date: end_date,
                            status_id: status_id,
                        },
                        success: function () {
                            toastr.success('Fiyat Listesi Başarıyla Kopyalandı');
                            priceLists.ajax.reload().draw();
                        },
                        error: function (error) {
                            toastr.error('Fiyat Listesi Kopyalanırken Bir Hata Oluştu!');
                            console.log(error)
                        }
                    });
                }
            },
            error: function () {

            }
        });
    });

    DeleteButton.click(function () {
        $("#DeleteModal").modal('hide');
        var id = $("#id_edit").val();
        $.ajax({
            type: 'delete',
            url: '{{ route('ajax.priceList.drop') }}',
            data: {
                _token: '{{ csrf_token() }}',
                auth_user_id: '{{ auth()->user()->id() }}',
                id: id,
            },
            success: function (response) {
                if (response.type === 'success') {
                    toastr.success(response.message);
                    priceLists.ajax.reload().draw();
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

    function savePriceList(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.priceList.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#create_rightbar_toggle").click();
                } else if (direction === 1) {
                    $("#edit_rightbar_toggle").click();
                }
                var currentPage = priceLists.page.info().page;
                priceLists.ajax.reload().page(currentPage).draw('page');
            },
            error: function (error) {
                toastr.success(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = priceLists.rows({selected: true});
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

    $('#priceLists tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            priceLists.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#priceListsCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            priceLists.rows().deselect();
        }
    });

    priceListItems.on('select', function (e) {
        var selectedRows = priceListItems.rows({selected: true});
        if (selectedRows.count() > 0) {
            priceListItemDeleteIcon.show();
            priceListItemEditIcon.show();
            $("#price_list_item_id_edit").val(selectedRows.data()[0].id.replace('#', ''));
        } else {
            priceListItemDeleteIcon.hide();
            priceListItemEditIcon.hide();
            $("#EditingContexts").hide();
        }
    });

    priceListItems.on('deselect', function (e) {
        priceListItemDeleteIcon.hide();
        priceListItemEditIcon.hide();
    });

    priceListItemDeleteIcon.click(function () {
        var id = $("#price_list_item_id_edit").val();
        if (id) {
            $.ajax({
                type: 'delete',
                url: '{{ route('ajax.priceListItem.drop') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function () {
                    priceListItems.ajax.reload().draw();
                },
                error: function () {
                    toastr.error('Satır Silinirken Bir Hata Oluştu!');
                }
            });
        }
    });

    priceListItemCreateIcon.click(function () {
        CreatePriceListItemForm.trigger('reset');
        priceListItemStockIdCreate.selectpicker('refresh');
        $("#CreatePriceListItemModal").modal('show');
    });

    priceListItemStockIdCreate.change(function () {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.stock.show') }}',
            data: {
                id: $(this).val()
            },
            success: function (stock) {
                $("#price_list_item_unit_price_create").val(stock.unit_price);
                $("#price_list_item_vat_rate_create").val(stock.retrail_vat);
                $("#price_list_item_currency_type_create").val(stock.currency_type).selectpicker('refresh');
            },
            error: function () {

            }
        });
    });

    priceListItemEditIcon.click(function () {
        var id = $("#price_list_item_id_edit").val();
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.priceListItem.show') }}',
            data: {
                id: id
            },
            success: function (priceListItem) {
                $("#price_list_item_stock_id_edit").val(priceListItem.stock_id).selectpicker('refresh');
                $("#price_list_item_unit_price_edit").val(priceListItem.unit_price);
                $("#price_list_item_vat_rate_edit").val(priceListItem.vat_rate);
                $("#price_list_item_currency_type_edit").val(priceListItem.currency_type).selectpicker('refresh');
                $("#EditPriceListItemModal").modal('show');
            },
            error: function (error) {
                toastr.error('Kalem Verisi Alınırken Bir Hata Oluştu!');
                console.log(error);
            }
        });

    });

    priceListItemStockIdEdit.change(function () {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.stock.show') }}',
            data: {
                id: $(this).val()
            },
            success: function (stock) {
                $("#price_list_item_unit_price_edit").val(stock.unit_price);
                $("#price_list_item_vat_rate_edit").val(stock.retrail_vat);
                $("#price_list_item_currency_type_edit").val(stock.currency_type).selectpicker('refresh');
            },
            error: function () {

            }
        });
    });

    CreatePriceListItemButton.click(function () {
        var price_list_id = $("#id_edit").val();
        var stock_id = $("#price_list_item_stock_id_create").val();
        var unit_price = $("#price_list_item_unit_price_create").val();
        var vat_rate = $("#price_list_item_vat_rate_create").val();
        var currency_type = $("#price_list_item_currency_type_create").val();

        if (price_list_id == null || price_list_id === '') {
            toastr.error('Fiyat Listesi Seçiminde Sistemsel Bi Hata Oluştu! Yöneticiniz İle İletişime Geçin.');
        } else if (stock_id == null || stock_id === '') {
            toastr.warning('Mal/Hizmet Seçilmesi Zorunludur!');
        } else if (unit_price == null || unit_price === '') {
            toastr.warning('Birim Fiyat Boş Olamaz!');
        } else {
            savePriceListItem({
                _token: '{{ csrf_token() }}',
                price_list_id: price_list_id,
                stock_id: stock_id,
                unit_price: unit_price,
                vat_rate: vat_rate,
                currency_type: currency_type,
            }, 'Yeni Mal/Hizmet Başarıyla Eklendi', 'Mal/Hizmet Eklenirken Sistemsel Bir Hata Oluştu!', 0);
        }
    });

    UpdatePriceListItemButton.click(function () {
        var id = $("#price_list_item_id_edit").val();
        var price_list_id = $("#id_edit").val();
        var stock_id = $("#price_list_item_stock_id_edit").val();
        var unit_price = $("#price_list_item_unit_price_edit").val();
        var vat_rate = $("#price_list_item_vat_rate_edit").val();
        var currency_type = $("#price_list_item_currency_type_edit").val();

        if (price_list_id == null || price_list_id === '') {
            toastr.error('Fiyat Listesi Seçiminde Sistemsel Bi Hata Oluştu! Yöneticiniz İle İletişime Geçin.');
        } else if (stock_id == null || stock_id === '') {
            toastr.warning('Mal/Hizmet Seçilmesi Zorunludur!');
        } else if (unit_price == null || unit_price === '') {
            toastr.warning('Birim Fiyat Boş Olamaz!');
        } else {
            savePriceListItem({
                _token: '{{ csrf_token() }}',
                id: id,
                price_list_id: price_list_id,
                stock_id: stock_id,
                unit_price: unit_price,
                vat_rate: vat_rate,
                currency_type: currency_type,
            }, 'Mal/Hizmet Başarıyla Güncellendi', 'Mal/Hizmet Güncellenirken Sistemsel Bir Hata Oluştu!', 1);
        }
    });

    function savePriceListItem(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.priceListItem.save') }}',
            data: data,
            success: function () {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#CreatePriceListItemModal").modal('hide');
                } else if (direction === 1) {
                    $("#EditPriceListItemModal").modal('hide');
                }
                priceListItems.ajax.reload().draw();
            },
            error: function (error) {
                toastr.success(errorMessage);
                console.log(error)
            }
        });
    }
</script>
