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

    var offerSubtotalInput = $("#offerSubtotalInput");
    var offerDiscountTotalInput = $("#offerDiscountTotalInput");
    var offerVatTotalInput = $("#offerVatTotalInput");
    var offerGrandTotalInput = $("#offerGrandTotalInput");

    var newOfferSubtotalInput = $("#newOfferSubtotalInput");
    var newOfferDiscountTotalInput = $("#newOfferDiscountTotalInput");
    var newOfferVatTotalInput = $("#newOfferVatTotalInput");
    var newOfferGrandTotalInput = $("#newOfferGrandTotalInput");

    var SelectedCompany = $("#SelectedCompany");

    var CreateOfferItemForm = $("#CreateOfferItemForm");
    var NewOfferCreateOfferItemForm = $("#NewOfferCreateOfferItemForm");

    var CreateOfferItemButton = $("#CreateOfferItemButton");
    var NewOfferCreateOfferItemButton = $("#NewOfferCreateOfferItemButton");

    var offerItemDeleteIcon = $("#offerItemDeleteIcon");
    var newOfferItemDeleteIcon = $("#newOfferItemDeleteIcon");

    var offerItemCreateIcon = $("#offerItemCreateIcon");
    var newOfferItemCreateIcon = $("#newOfferItemCreateIcon");

    var companyIdCreate = $("#company_id_create");
    var userIdCreate = $("#user_id_create");
    var relationTypeCreate = $("#relation_type_create");
    var relationIdCreate = $("#relation_id_create");
    var payTypeIdCreate = $("#pay_type_id_create");
    var deliveryTypeIdCreate = $("#delivery_type_id_create");
    var statusIdCreate = $("#status_id_create");

    var companyIdEdit = $("#company_id_edit");
    var userIdEdit = $("#user_id_edit");
    var relationTypeEdit = $("#relation_type_edit");
    var relationIdEdit = $("#relation_id_edit");
    var payTypeIdEdit = $("#pay_type_id_edit");
    var deliveryTypeIdEdit = $("#delivery_type_id_edit");
    var statusIdEdit = $("#status_id_edit");

    var offerItemStockIdCreate = $("#offer_item_stock_id_create");
    var newOfferItemStockIdCreate = $("#new_offer_item_stock_id_create");
    var offerItemUnitIdCreate = $("#offer_item_unit_id_create");
    var newOfferItemUnitIdCreate = $("#new_offer_item_unit_id_create");

    var offerItemAmountCreate = $("#offer_item_amount_create");
    var offerItemUnitPriceCreate = $("#offer_item_unit_price_create");
    var offerItemVatRateCreate = $("#offer_item_vat_rate_create");
    var offerItemDiscountRateCreate = $("#offer_item_discount_rate_create");

    var newOfferItemAmountCreate = $("#new_offer_item_amount_create");
    var newOfferItemUnitPriceCreate = $("#new_offer_item_unit_price_create");
    var newOfferItemVatRateCreate = $("#new_offer_item_vat_rate_create");
    var newOfferItemDiscountRateCreate = $("#new_offer_item_discount_rate_create");

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");
    var DeleteButton = $("#DeleteButton");
    var SendEmailButton = $("#SendEmailButton");

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

        initComplete: function () {
            var r = $('#offers tfoot tr');
            $('#offers thead').append(r);
            this.api().columns().every(function (index) {
                var column = this;
                var input = document.createElement('input');

                if (index === 4) {
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
                } else if (index === 5) {
                    input = null;
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                    return;
                } else if (index === 2) {
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
            url: '{{ route('ajax.offer.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val()
                });
            },
        },
        columns: [
            {data: 'id', name: 'id', width: '5%'},
            {data: 'subject', name: 'subject'},
            {data: 'expiry_date', name: 'expiry_date', width: '8%'},
            {data: 'status_id', name: 'status_id'},
            {data: 'relation_type', name: 'relation_type'},
            {data: 'relation_id', name: 'relation_id'},
            {data: 'company_id', name: 'company_id'},
            {data: 'user_id', name: 'user_id'},
        ],

        responsive: true,
        stateSave: true,
        colReorder: true,
        select: 'single'
    });

    var offerItems = $('#offerItems').DataTable({
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
            url: '{{ route('ajax.offerItem.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    offer_id: $("#id_edit").val()
                });
            },
            complete: function (response) {
                var subtotal = 0;
                var discount_total = 0;
                var vat_total = 0;
                var grand_total = 0;

                $.each(response.responseJSON.data, function (index) {
                    subtotal = subtotal + response.responseJSON.data[index].subtotal;
                    discount_total = discount_total + response.responseJSON.data[index].discount_total;
                    vat_total = vat_total + response.responseJSON.data[index].vat_total;
                    grand_total = grand_total + response.responseJSON.data[index].grand_total;
                });

                var currencyType = $("#currency_type_edit").find("option:selected").val();

                offerSubtotalInput.val(parseFloat(subtotal).toFixed(2) + " " + currencyType);
                offerDiscountTotalInput.val(parseFloat(discount_total).toFixed(2) + " " + currencyType);
                offerVatTotalInput.val(parseFloat(vat_total).toFixed(2) + " " + currencyType);
                offerGrandTotalInput.val(parseFloat(grand_total).toFixed(2) + " " + currencyType);
            }
        },
        columns: [
            {data: 'stock_id', name: 'stock_id'},
            {data: 'amount', name: 'amount'},
            {data: 'unit_id', name: 'unit_id'},
            {data: 'unit_price', name: 'unit_price'},
            {data: 'discount_rate', name: 'discount_rate'},
            {data: 'discount_total', name: 'discount_total'},
            {data: 'subtotal', name: 'subtotal'},
            {data: 'vat_rate', name: 'vat_rate'},
            {data: 'vat_total', name: 'vat_total'},
            {data: 'grand_total', name: 'grand_total'},
        ],

        responsive: true,
        stateSave: true,
        select: 'single'
    });

    var newOfferItems = $('#newOfferItems').DataTable({
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

        columnDefs: [
            {
                "targets": [0],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [1],
                "visible": false,
                "searchable": false
            }
        ],

        order: [
            [
                0,
                "desc"
            ]
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

    function calculateOfferItemInputs() {
        var amount = offerItemAmountCreate.val();
        var unit_price = offerItemUnitPriceCreate.val();
        var vat_rate = offerItemVatRateCreate.val();
        var discount_rate = offerItemDiscountRateCreate.val();

        var subtotalWithoutDiscount = amount * unit_price;
        var discount_total = subtotalWithoutDiscount * discount_rate / 100;
        var subtotal = subtotalWithoutDiscount - discount_total;
        var vat_total = subtotal * vat_rate / 100;
        var grand_total = subtotal + vat_total;

        $("#offer_item_vat_total_create").val(vat_total);
        $("#offer_item_discount_total_create").val(discount_total);
        $("#offer_item_subtotal_create").val(subtotal);
        $("#offer_item_grand_total_create").val(grand_total);
    }

    function calculateNewOfferItemInputs() {
        var amount = newOfferItemAmountCreate.val();
        var unit_price = newOfferItemUnitPriceCreate.val();
        var vat_rate = newOfferItemVatRateCreate.val();
        var discount_rate = newOfferItemDiscountRateCreate.val();

        var subtotalWithoutDiscount = amount * unit_price;
        var discount_total = subtotalWithoutDiscount * discount_rate / 100;
        var subtotal = subtotalWithoutDiscount - discount_total;
        var vat_total = subtotal * vat_rate / 100;
        var grand_total = subtotal + vat_total;

        $("#new_offer_item_vat_total_create").val(vat_total);
        $("#new_offer_item_discount_total_create").val(discount_total);
        $("#new_offer_item_subtotal_create").val(subtotal);
        $("#new_offer_item_grand_total_create").val(grand_total);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////

    $("#currency_type_create").change(function () {
        $("#currency_create").attr('disabled', true);
        calculateNewOfferItemTotals();
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.offer.getCurrency') }}',
            data: {
                currency_code: $(this).val()
            },
            success: function (response) {
                $("#currency_create").val(response.ForexSelling);
                $("#currency_create").attr('disabled', false);
            },
            error: function () {

            }
        });
    });

    $("#currency_type_edit").change(function () {
        offerItems.ajax.reload().draw();
    });

    function calculateNewOfferItemTotals() {
        var selectedRows = newOfferItems.rows();

        var subtotal = 0;
        var discount_total = 0;
        var vat_total = 0;
        var grand_total = 0;

        $.each(selectedRows.data(), function (index) {
            subtotal = subtotal + parseFloat(selectedRows.data()[index][8]);
            discount_total = discount_total + parseFloat(selectedRows.data()[index][7]);
            vat_total = vat_total + parseFloat(selectedRows.data()[index][10]);
            grand_total = grand_total + parseFloat(selectedRows.data()[index][11]);
        });

        var currencyType = $("#currency_type_create").find("option:selected").val();

        newOfferSubtotalInput.val(subtotal.toFixed(2) + " " + currencyType);
        newOfferDiscountTotalInput.val(discount_total.toFixed(2) + " " + currencyType);
        newOfferVatTotalInput.val(vat_total.toFixed(2) + " " + currencyType);
        newOfferGrandTotalInput.val(grand_total.toFixed(2) + " " + currencyType);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////

    function create() {
        $("#CreateForm").trigger('reset');
        companyIdCreate.val(SelectedCompany.val()).selectpicker('refresh');
        getUsers(SelectedCompany.val());
        getRelationsCreate(SelectedCompany.val());
        getPayTypes(SelectedCompany.val());
        getDeliveryTypes(SelectedCompany.val());
        getOfferStatuses(SelectedCompany.val());
        userIdCreate.selectpicker('refresh');
        relationTypeCreate.selectpicker('refresh');
        relationIdCreate.selectpicker('refresh');
        statusIdCreate.selectpicker('refresh');
        payTypeIdCreate.selectpicker('refresh');
        deliveryTypeIdCreate.selectpicker('refresh');
        $("#calendar_create").selectpicker('refresh');
        newOfferItems.rows().remove().draw();
        calculateNewOfferItemTotals();
        $("#create_rightbar_toggle").trigger('click');
    }

    function edit() {
        $("#edit_rightbar_toggle").trigger('click');
        $("#EditRightbar").hide();
        offerItemDeleteIcon.hide();
        var id = $("#id_edit").val();
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.offer.show') }}',
            data: {
                id: id
            },
            success: function (offer) {
                $("#company_id_edit").val(offer.company_id).selectpicker('refresh');
                getUsers(companyIdEdit.val());
                userIdEdit.val(offer.user_id).selectpicker('refresh');
                relationTypeEdit.val(offer.relation_type).selectpicker('refresh');
                getRelationsEdit(offer.relation_id, offer.company_id);
                $("#subject_edit").val(offer.subject);
                $("#expiry_date_edit").val(offer.expiry_date);
                $("#pay_type_id_edit").val(offer.pay_type_id).selectpicker('refresh');
                $("#delivery_type_id_edit").val(offer.delivery_type_id).selectpicker('refresh');
                $("#currency_type_edit").val(offer.currency_type).selectpicker('refresh');
                $("#currency_edit").val(offer.currency);
                $("#status_id_edit").val(offer.status_id).selectpicker('refresh');
                $("#description_edit").val(offer.description);
                $("#calendar_edit").val(offer.calendar);
                offerItems.ajax.reload().draw();
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
        $("#DeleteModal").modal('show');
    }

    function downloadPDF() {
        var id = $("#id_edit").val();
        toastr.info('Dosya Hazırlanıyor Lütfen Bekleyin...');
        window.location.href = '{{ route('ajax.offer.downloadPDF') }}?id=' + id;
    }

    function sendEmailModal() {
        var id = $("#id_edit").val();
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.offer.show') }}',
            data: {
                id: id
            },
            success: function (offer) {
                $("#SendEmailModal").modal('show');
                $("#send_email").val(offer.relation.email ?? '');
            },
            error: function (error) {
                toastr.error('Teklif Detayları Alınırken Sistemsel Bir Hata Oluştu!');
                console.log(error);
            }
        });
    }

    SendEmailButton.click(function () {
        var id = $("#id_edit").val();
        var email = $("#send_email").val();
        $("#SendEmailModal").modal('hide');
        $("#loader").fadeIn(250);
        toastr.info('Mail Gönderiliyor...');
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.offer.sendEmail') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                email: email
            },
            success: function (response) {
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

    function getPayTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.offerPayTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (payTypes) {
                payTypeIdCreate.empty();
                payTypeIdEdit.empty();
                $.each(payTypes, function (index) {
                    payTypeIdCreate.append(`<option value="${payTypes[index].id}">${payTypes[index].name}</option>`);
                    payTypeIdEdit.append(`<option value="${payTypes[index].id}">${payTypes[index].name}</option>`);
                });
                payTypeIdCreate.selectpicker('refresh');
                payTypeIdEdit.selectpicker('refresh');
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
                deliveryTypeIdCreate.empty();
                deliveryTypeIdEdit.empty();
                $.each(deliveryTypes, function (index) {
                    deliveryTypeIdCreate.append(`<option value="${deliveryTypes[index].id}">${deliveryTypes[index].name}</option>`);
                    deliveryTypeIdEdit.append(`<option value="${deliveryTypes[index].id}">${deliveryTypes[index].name}</option>`);
                });
                deliveryTypeIdCreate.selectpicker('refresh');
                deliveryTypeIdEdit.selectpicker('refresh');
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
                statusIdCreate.empty();
                statusIdEdit.empty();
                $.each(offerStatuses, function (index) {
                    statusIdCreate.append(`<option value="${offerStatuses[index].id}">${offerStatuses[index].name}</option>`);
                    statusIdEdit.append(`<option value="${offerStatuses[index].id}">${offerStatuses[index].name}</option>`);
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
                offerItemStockIdCreate.empty();
                newOfferItemStockIdCreate.empty();
                offerItemStockIdCreate.append(`<option value="" selected hidden disabled></option>`);
                newOfferItemStockIdCreate.append(`<option value="" selected hidden disabled></option>`);
                $.each(stocks, function (index) {
                    offerItemStockIdCreate.append(`<option value="${stocks[index].id}">${stocks[index].name}</option>`);
                    newOfferItemStockIdCreate.append(`<option value="${stocks[index].id}">${stocks[index].name}</option>`);
                });
                offerItemStockIdCreate.selectpicker('refresh');
                newOfferItemStockIdCreate.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getUnits(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.unitTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (unitTypes) {
                offerItemUnitIdCreate.empty();
                newOfferItemUnitIdCreate.empty();
                offerItemUnitIdCreate.append(`<option value="" selected hidden disabled></option>`);
                newOfferItemUnitIdCreate.append(`<option value="" selected hidden disabled></option>`);
                $.each(unitTypes, function (index) {
                    offerItemUnitIdCreate.append(`<option value="${unitTypes[index].id}">${unitTypes[index].name}</option>`);
                    newOfferItemUnitIdCreate.append(`<option value="${unitTypes[index].id}">${unitTypes[index].name}</option>`);
                });
                offerItemUnitIdCreate.selectpicker('refresh');
                newOfferItemUnitIdCreate.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getUsers(SelectedCompany.val());
    getStocks(SelectedCompany.val());
    getUnits(SelectedCompany.val());
    getRelationsCreate(SelectedCompany.val());
    getRelationsEdit(null, SelectedCompany.val());
    getPayTypes(SelectedCompany.val());
    getDeliveryTypes(SelectedCompany.val());
    getOfferStatuses(SelectedCompany.val());

    SelectedCompany.change(function () {
        getUsers($(this).val());
        getStocks($(this).val());
        getUnits($(this).val());
        getRelationsCreate($(this).val());
        getRelationsEdit(null, $(this).val());
        getPayTypes($(this).val());
        getDeliveryTypes($(this).val());
        getOfferStatuses($(this).val());
        offers.ajax.reload().draw();
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
        getPayTypes($(this).val());
        getDeliveryTypes($(this).val());
        getOfferStatuses($(this).val());
    });

    companyIdEdit.change(function () {
        getUsers($(this).val());
        getRelationsEdit(null, $(this).val());
        getPayTypes($(this).val());
        getDeliveryTypes($(this).val());
        getOfferStatuses($(this).val());
    });

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var user_id = $("#user_id_create").val();
        var company_id = $("#company_id_create").val();
        var relation_type = $("#relation_type_create").val();
        var relation_id = $("#relation_id_create").val();
        var subject = $("#subject_create").val();
        var expiry_date = $("#expiry_date_create").val();
        var pay_type_id = $("#pay_type_id_create").val();
        var delivery_type_id = $("#delivery_type_id_create").val();
        var currency_type = $("#currency_type_create").val();
        var currency = $("#currency_create").val();
        var status_id = $("#status_id_create").val();
        var description = $("#description_create").val();
        var calendar = $("#calendar_create").val();

        var items = [];

        var selectedRows = newOfferItems.rows();
        if (selectedRows.count() > 0) {
            $.each(selectedRows.data(), function (index) {
                items.push(selectedRows.data()[index]);
            });
        }

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else if (relation_type == null || relation_type === '' || relation_id == null || relation_id === '') {
            toastr.warning('Bağlantı Türü ve Bağlantı Seçimi Zorunludur!');
        } else {
            saveOffer({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                user_id: user_id,
                company_id: company_id,
                relation_type: relation_type,
                relation_id: relation_id,
                subject: subject,
                expiry_date: expiry_date,
                pay_type_id: pay_type_id,
                delivery_type_id: delivery_type_id,
                currency_type: currency_type,
                currency: currency,
                status_id: status_id,
                description: description,
                calendar: calendar,
                items: items
            }, 'Yeni Teklif Başarıyla Oluşturuldu', 'Teklif Oluşturulurken Bir Hata Oluştu!', 0);
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
        var expiry_date = $("#expiry_date_edit").val();
        var pay_type_id = $("#pay_type_id_edit").val();
        var delivery_type_id = $("#delivery_type_id_edit").val();
        var currency_type = $("#currency_type_edit").val();
        var currency = $("#currency_edit").val();
        var status_id = $("#status_id_edit").val();
        var description = $("#description_edit").val();
        var calendar = $("#calendar_edit").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else if (relation_type == null || relation_type === '' || relation_id == null || relation_id === '') {
            toastr.warning('Bağlantı Türü ve Bağlantı Seçimi Zorunludur!');
        } else {
            saveOffer({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                id: id,
                user_id: user_id,
                company_id: company_id,
                relation_type: relation_type,
                relation_id: relation_id,
                subject: subject,
                expiry_date: expiry_date,
                pay_type_id: pay_type_id,
                delivery_type_id: delivery_type_id,
                currency_type: currency_type,
                currency: currency,
                status_id: status_id,
                description: description,
                calendar: calendar,
            }, 'Teklif Başarıyla Güncellendi', 'Teklif Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    DeleteButton.click(function () {
        $("#DeleteModal").modal('hide');
        var id = $("#id_edit").val();
        $.ajax({
            type: 'delete',
            url: '{{ route('ajax.offer.drop') }}',
            data: {
                _token: '{{ csrf_token() }}',
                auth_user_id: '{{ auth()->user()->id() }}',
                id: id,
            },
            success: function (response) {
                if (response.type === 'success') {
                    toastr.success(response.message);
                    offers.ajax.reload().draw();
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

    function saveOffer(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.offer.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#create_rightbar_toggle").click();
                } else if (direction === 1) {
                    $("#edit_rightbar_toggle").click();
                }
                offers.ajax.reload().draw();
            },
            error: function (error) {
                toastr.success(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = offers.rows({selected: true});
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

    $('#offers tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            offers.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#offersCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            offers.rows().deselect();
        }
    });

    ////////////////////////////////////////////////////////////////////////////////////////

    offerItems.on('select', function (e) {
        var selectedRows = offerItems.rows({selected: true});
        if (selectedRows.count() > 0) {
            offerItemDeleteIcon.show();
            $("#offer_item_id_edit").val(selectedRows.data()[0].id.replace('#', ''));
        } else {
            offerItemDeleteIcon.hide();
            $("#EditingContexts").hide();
        }
    });

    offerItems.on('deselect', function (e) {
        offerItemDeleteIcon.hide();
    });

    offerItemDeleteIcon.click(function () {
        var id = $("#offer_item_id_edit").val();
        if (id) {
            $.ajax({
                type: 'delete',
                url: '{{ route('ajax.offerItem.drop') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function () {
                    offerItems.ajax.reload().draw();
                },
                error: function () {
                    toastr.error('Satır Silinirken Bir Hata Oluştu!');
                }
            });
        }
    });

    offerItemCreateIcon.click(function () {
        CreateOfferItemForm.trigger('reset');
        offerItemStockIdCreate.selectpicker('refresh');
        offerItemUnitIdCreate.selectpicker('refresh');
        offerItemAmountCreate.val(1);
        offerItemDiscountRateCreate.val(0);
        $("#CreateOfferItemModal").modal('show');
    });

    offerItemStockIdCreate.change(function () {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.stock.show') }}',
            data: {
                id: $(this).val()
            },
            success: function (stock) {
                offerItemUnitPriceCreate.val(stock.unit_price);
                $("#offer_item_unit_id_create").val(stock.unit_type_id).selectpicker('refresh');
                offerItemVatRateCreate.val(stock.wholesale_vat);
                calculateOfferItemInputs();
            },
            error: function () {

            }
        });
    });

    offerItemAmountCreate.change(function () {
        calculateOfferItemInputs();
    });

    offerItemUnitPriceCreate.change(function () {
        calculateOfferItemInputs();
    });

    offerItemVatRateCreate.change(function () {
        calculateOfferItemInputs();
    });

    offerItemDiscountRateCreate.change(function () {
        calculateOfferItemInputs();
    });

    CreateOfferItemButton.click(function () {
        var offer_id = $("#id_edit").val();
        var stock_id = $("#offer_item_stock_id_create").val();
        var amount = $("#offer_item_amount_create").val();
        var unit_id = $("#offer_item_unit_id_create").val();
        var unit_price = $("#offer_item_unit_price_create").val();
        var vat_rate = $("#offer_item_vat_rate_create").val();
        var vat_total = $("#offer_item_vat_total_create").val();
        var discount_rate = $("#offer_item_discount_rate_create").val();
        var discount_total = $("#offer_item_discount_total_create").val();
        var subtotal = $("#offer_item_subtotal_create").val();
        var grand_total = $("#offer_item_grand_total_create").val();
        var description = $("#offer_item_description_create").val();

        if (offer_id == null || offer_id === '') {
            toastr.error('Teklif Seçiminde Sistemsel Bi Hata Oluştu! Yöneticiniz İle İletişime Geçin.');
        } else if (stock_id == null || stock_id === '') {
            toastr.warning('Mal/Hizmet Seçilmesi Zorunludur!');
        } else if (amount == null || amount === '') {
            toastr.warning('Miktar Boş Olamaz!');
        } else if (unit_id == null || unit_id === '') {
            toastr.warning('Birim Seçilmesi Zorunludur!');
        } else if (unit_price == null || unit_price === '') {
            toastr.warning('Birim Fiyat Boş Olamaz!');
        } else if (vat_rate == null || vat_rate === '') {
            toastr.warning('KDV Oranı Boş Olamaz!');
        } else if (discount_rate == null || discount_rate === '') {
            toastr.warning('İskonto Oranı Boş Olamaz!');
        } else {
            $.ajax({
                type: 'post',
                url: '{{ route('ajax.offerItem.save') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    offer_id: offer_id,
                    stock_id: stock_id,
                    amount: amount,
                    unit_id: unit_id,
                    unit_price: unit_price,
                    vat_rate: vat_rate,
                    vat_total: vat_total,
                    discount_rate: discount_rate,
                    discount_total: discount_total,
                    subtotal: subtotal,
                    grand_total: grand_total,
                    description: description,
                },
                success: function () {
                    $("#CreateOfferItemModal").modal('hide');
                    offerItems.ajax.reload().draw();
                },
                error: function (error) {
                    console.log(error)
                    toastr.error('Mal/Hizmet Eklenirken Sistemsel Bir Hata Oluştu!');
                }
            });
        }
    });

    ////////////////////////////////////////////////////////////////////////////////////////

    newOfferItems.on('select', function (e) {
        var selectedRows = newOfferItems.rows({selected: true});
        if (selectedRows.count() > 0) {
            newOfferItemDeleteIcon.show();
        } else {
            newOfferItemDeleteIcon.hide();
        }
    });

    newOfferItems.on('deselect', function (e) {
        newOfferItemDeleteIcon.hide();
    });

    newOfferItemDeleteIcon.click(function () {
        var selectedRows = newOfferItems.rows({selected: true});
        if (selectedRows.count() > 0) {
            newOfferItems.rows('.selected').remove().draw();
        }
        calculateNewOfferItemTotals();
    });

    newOfferItemCreateIcon.click(function () {
        NewOfferCreateOfferItemForm.trigger('reset');
        newOfferItemStockIdCreate.selectpicker('refresh');
        newOfferItemUnitIdCreate.selectpicker('refresh');
        newOfferItemAmountCreate.val(1);
        newOfferItemDiscountRateCreate.val(0);
        $("#NewOfferCreateOfferItemModal").modal('show');
    });

    newOfferItemStockIdCreate.change(function () {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.stock.show') }}',
            data: {
                id: $(this).val()
            },
            success: function (stock) {
                newOfferItemUnitPriceCreate.val(stock.unit_price);
                $("#new_offer_item_unit_id_create").val(stock.unit_type_id).selectpicker('refresh');
                newOfferItemVatRateCreate.val(stock.wholesale_vat);
                calculateNewOfferItemInputs();
            },
            error: function () {

            }
        });
    });

    newOfferItemAmountCreate.change(function () {
        calculateNewOfferItemInputs();
    });

    newOfferItemUnitPriceCreate.change(function () {
        calculateNewOfferItemInputs();
    });

    newOfferItemVatRateCreate.change(function () {
        calculateNewOfferItemInputs();
    });

    newOfferItemDiscountRateCreate.change(function () {
        calculateNewOfferItemInputs();
    });

    NewOfferCreateOfferItemButton.click(function () {
        var stock_id = $("#new_offer_item_stock_id_create").val();
        var stock_name = $("#new_offer_item_stock_id_create").find("option:selected").text();
        var amount = $("#new_offer_item_amount_create").val();
        var unit_id = $("#new_offer_item_unit_id_create").val();
        var unit_name = $("#new_offer_item_unit_id_create").find("option:selected").text();
        var unit_price = $("#new_offer_item_unit_price_create").val();
        var vat_rate = $("#new_offer_item_vat_rate_create").val();
        var vat_total = $("#new_offer_item_vat_total_create").val();
        var discount_rate = $("#new_offer_item_discount_rate_create").val();
        var discount_total = $("#new_offer_item_discount_total_create").val();
        var subtotal = $("#new_offer_item_subtotal_create").val();
        var grand_total = $("#new_offer_item_grand_total_create").val();
        var description = $("#new_offer_item_description_create").val();

        if (stock_id == null || stock_id === '') {
            toastr.warning('Mal/Hizmet Seçilmesi Zorunludur!');
        } else if (amount == null || amount === '') {
            toastr.warning('Miktar Boş Olamaz!');
        } else if (unit_id == null || unit_id === '') {
            toastr.warning('Birim Seçilmesi Zorunludur!');
        } else if (unit_price == null || unit_price === '') {
            toastr.warning('Birim Fiyat Boş Olamaz!');
        } else if (vat_rate == null || vat_rate === '') {
            toastr.warning('KDV Oranı Boş Olamaz!');
        } else if (discount_rate == null || discount_rate === '') {
            toastr.warning('İskonto Oranı Boş Olamaz!');
        } else {
            newOfferItems.row.add([
                stock_id,
                unit_id,
                stock_name,
                amount,
                unit_name,
                unit_price,
                discount_rate,
                discount_total,
                subtotal,
                vat_rate,
                vat_total,
                grand_total
            ]).draw(false);
            $("#NewOfferCreateOfferItemModal").modal('hide');
            calculateNewOfferItemTotals();
        }
    });
</script>
