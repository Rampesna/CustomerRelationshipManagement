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

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");
    var DeleteButton = $("#DeleteButton");

    var statusSelector = $('#statusSelector');

    var tickets = $('#tickets').DataTable({
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

        initComplete: function () {
            var r = $('#tickets tfoot tr');
            $('#tickets thead').append(r);
            this.api().columns().every(function (index) {
                var column = this;
                var input = document.createElement('input');

                if (index === 2) {
                    input = null;
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                    return;
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
            url: '{{ route('ajax.ticket.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    status: statusSelector.val()
                });
            },
        },
        columns: [
            {data: 'id', name: 'id', width: '7%'},
            {data: 'subject', name: 'subject'},
            {data: 'status_id', name: 'status_id', sortable: false, searchable: false}
        ],

        order: [
            [0, 'desc']
        ],

        responsive: true,
        select: 'single'
    });

    function setStatus(val) {
        statusSelector.val(val);
        tickets.ajax.reload();
    }

    function create() {
        $("#create_rightbar_toggle").trigger('click');
    }

    function show() {
        var id = $('#id_edit').val();
        var url = '{{ route('ticket.show') }}';
        $(location).attr('href', `${url}/${id}`)
    }

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

    CreateButton.click(function () {
        var subject = $('#subject_create').val();
        var description = $('#description_create').val();

        if (subject == null || subject === '') {
            toastr.warning('Talep Başlığı Boş Olamaz!');
        } else if (description == null || description === '') {
            toastr.warning('Talep İçeriği Boş Olamaz!');
        } else {
            var data = new FormData();
            data.append('_token', '{{ csrf_token() }}');
            data.append('user_id', '{{ auth()->id() }}');
            data.append('subject', subject);
            data.append('description', description);

            var totalfiles = document.getElementById('images_create').files.length;
            for (var index = 0; index < totalfiles; index++) {
                data.append("images[]", document.getElementById('images_create').files[index]);
            }

            data.append('status_id', 1);

            saveTicket(data, 0);
        }
    });

    function saveTicket(data, direction) {
        $.ajax({
            async: false,
            processData: false,
            contentType: false,
            type: 'post',
            url: '{{ route('ajax.ticket.save') }}',
            data: data,
            success: function (response) {
                toastr.success('Yeni Talep Başarıyla Oluşturuldu!');
                if (direction === 0) {
                    $("#create_rightbar_toggle").click();
                    $('#CreateForm').trigger('reset');
                } else if (direction === 1) {
                    $("#edit_rightbar_toggle").click();
                }
                var currentPage = tickets.page.info().page;
                tickets.ajax.reload().page(currentPage).draw('page');
            },
            error: function (error) {
                toastr.error('Destek Talebi Oluşturulurken Bir Hata Oluştu!');
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = tickets.rows({selected: true});
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

    $('#tickets tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            tickets.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#ticketsCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            tickets.rows().deselect();
        }
    });
</script>
