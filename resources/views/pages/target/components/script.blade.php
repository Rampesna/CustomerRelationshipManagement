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
    var typeCreate = $("#type_create");

    var companyIdEdit = $("#company_id_edit");
    var typeEdit = $("#type_edit");

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");
    var DeleteButton = $("#DeleteButton");

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
                    targets.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#targets tfoot tr');
            $('#targets thead').append(r);
            this.api().columns().every(function (index) {
                var column = this;
                var input = document.createElement('input');

                if (index === 2) {
                    input = document.createElement('select');
                    var option = document.createElement("option");
                    option.setAttribute("value", 'all');
                    option.innerHTML = "Tümü";
                    input.appendChild(option);

                    option = document.createElement("option");
                    option.setAttribute("value", 'opportunity');
                    option.innerHTML = "Fırsat";
                    input.appendChild(option);

                    option = document.createElement("option");
                    option.setAttribute("value", 'activity');
                    option.innerHTML = "Aktivite";
                    input.appendChild(option);
                } else if (index === 1) {
                    input.setAttribute("type", "month");
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
            url: '{{ route('ajax.target.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    company_id: SelectedCompany.val()
                });
            },
        },
        columns: [
            {data: 'company_id', name: 'company_id'},
            {data: 'date', name: 'date'},
            {data: 'type', name: 'type'},
            {data: 'target', name: 'target'},
        ],

        responsive: true,
        stateSave: true,
        colReorder: true,
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
        companyIdCreate.selectpicker('refresh');
        $("#type_create").selectpicker('refresh');
        $("#create_rightbar_toggle").trigger('click');
    }

    function edit() {
        $("#edit_rightbar_toggle").trigger('click');
        $("#EditRightbar").hide();

        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.target.show') }}',
            data: {
                id: id
            },
            success: function (target) {
                console.log(target)
                SelectedCompany.val(target.company_id).selectpicker('refresh');
                $("#company_id_edit").val(target.company_id).selectpicker('refresh');
                $("#date_edit").val(target.year + '-' + target.month);
                $("#type_edit").val(target.type).selectpicker('refresh');
                $("#target_edit").val(target.target);
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
        var selectedRows = targets.rows({selected: true});
        if (selectedRows.count() > 0) {
            $("#deleting").html(selectedRows.data()[0].month + '.' + selectedRows.data()[0].year ?? '');
        }
        $("#DeleteModal").modal('show');
    }

    SelectedCompany.change(function () {
        targets.ajax.reload().draw();
    });

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var company_id = $("#company_id_create").val();
        var type = $("#type_create").val();
        var date = $("#date_create").val();
        var target = $("#target_create").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else {
            saveTarget({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                company_id: company_id,
                type: type,
                date: date,
                target: target,
            }, 0);
        }
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var company_id = $("#company_id_edit").val();
        var type = $("#type_edit").val();
        var date = $("#date_edit").val();
        var target = $("#target_edit").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else {
            saveTarget({
                _token: '{{ csrf_token() }}',
                id: id,
                auth_user_id: auth_user_id,
                company_id: company_id,
                type: type,
                date: date,
                target: target,
            }, 1);
        }
    });

    DeleteButton.click(function () {
        $("#DeleteModal").modal('hide');
        var id = $("#id_edit").val();
        $.ajax({
            type: 'delete',
            url: '{{ route('ajax.target.drop') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            },
            success: function () {
                toastr.success('Başarıyla Silindi');
                targets.ajax.reload().draw();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Silinirken Sistemsel Bir Hata Oluştu!');
            }
        });
    });

    function saveTarget(data, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.target.save') }}',
            data: data,
            success: function (response) {
                if (response.type === 'success') {
                    toastr.success(response.message);
                } else if (response.type === 'error') {
                    toastr.error(response.message);
                } else if (response.type === 'warning') {
                    toastr.warning(response.message);
                } else {
                    toastr.info(response.message);
                }
                if (direction === 0) {
                    $("#create_rightbar_toggle").click();
                } else if (direction === 1) {
                    $("#edit_rightbar_toggle").click();
                }
                var currentPage = targets.page.info().page;
                targets.ajax.reload().page(currentPage).draw('page');
            },
            error: function (error) {
                toastr.success(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = targets.rows({selected: true});
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

    $('#targets tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            targets.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#targetsCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            targets.rows().deselect();
        }
    });
</script>
