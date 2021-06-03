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

    var subDefinitionDeleteIcon = $("#subDefinitionDeleteIcon");
    var subDefinitionCreateButton = $("#subDefinitionCreateButton");

    var companyIdEdit = $("#company_id_edit");

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");

    var definitions = $('#definitions').DataTable({
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

        buttons: [
            {
                text: '<i class="fas fa-undo"></i> Yenile',
                action: function (e, dt, node, config) {
                    $('table input').val('');
                    definitions.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        order: [
            [
                0,
                "desc"
            ]
        ],

        initComplete: function () {
            var r = $('#definitions tfoot tr');
            $('#definitions thead').append(r);
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
            url: '{{ route('ajax.definition.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val()
                });
            },
        },
        columns: [
            {data: 'name', name: 'name'},
        ],

        responsive: true,
        stateSave: true,
        select: 'single'
    });

    var subDefinitions = $('#subDefinitions').DataTable({
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
            url: '{{ route('ajax.definition.subDefinitions') }}',
            data: function (d) {
                return $.extend({}, d, {
                    definition_id: $("#id_edit").val()
                });
            },
        },
        columns: [
            {data: 'name', name: 'name'},
        ],

        responsive: true,
        stateSave: true,
        select: 'single'
    });

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

    function edit() {
        $("#edit_rightbar_toggle").click();
        subDefinitionDeleteIcon.hide();
        subDefinitions.ajax.reload().draw();
    }

    SelectedCompany.change(function () {
        definitions.ajax.reload().draw();
    });

    $('body').on('contextmenu', function (e) {
        var selectedRows = definitions.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id;
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

    $('#definitions tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            definitions.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#definitionsCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            definitions.rows().deselect();
        }
    });

    subDefinitions.on('select', function (e) {
        var selectedRows = subDefinitions.rows({selected: true});
        if (selectedRows.count() > 0) {
            subDefinitionDeleteIcon.show();
            $("#sub_definition_id_edit").val(selectedRows.data()[0].id);
        } else {
            subDefinitionDeleteIcon.hide();
        }
    });

    subDefinitions.on('deselect', function (e) {
        subDefinitionDeleteIcon.hide();
    });

    subDefinitionDeleteIcon.click(function () {
        var id = $("#sub_definition_id_edit").val();
        if (id) {
            $.ajax({
                type: 'delete',
                url: '{{ route('ajax.definition.drop') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function () {
                    subDefinitions.ajax.reload().draw();
                },
                error: function () {
                    toastr.error('Tanımlama Silinirken Bir Hata Oluştu!');
                }
            });
        }
    });

    subDefinitionCreateButton.click(function () {
        var definition_id = $("#id_edit").val();
        var company_id = SelectedCompany.val();
        var name = $("#sub_definition_name_create").val();

        if (definition_id == null || definition_id === '') {
            toastr.error('Ana Tanımlama Seçiminde Sistemsel Bir Hata Oluştu! Yönetici İle İletişime Geçin.');
        } else if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçiminde Sistemsel Bir Hata Oluştu! Yönetici İle İletişime Geçin.');
        } else if (name == null || name === '') {
            toastr.warning('Tanımlama Adı Boş Olamaz!');
        } else {
            $.ajax({
                type: 'post',
                url: '{{ route('ajax.definition.save') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    definition_id: definition_id,
                    company_id: company_id,
                    name: name,
                },
                success: function () {
                    subDefinitions.ajax.reload().draw();
                    $("#sub_definition_name_create").val('')
                },
                error: function (error) {
                    console.log(error)
                    toastr.error('Tanımlama Eklenirken Bir Hata Oluştu!');
                }
            });
        }
    });
</script>
