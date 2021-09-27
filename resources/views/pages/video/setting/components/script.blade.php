<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");
    var DeleteButton = $("#DeleteButton");

    var videos = $('#videos').DataTable({
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
            var r = $('#videos tfoot tr');
            $('#videos thead').append(r);
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
            url: '{{ route('ajax.video.datatable') }}'
        },
        columns: [
            {data: 'id', name: 'id', width: '3%'},
            {data: 'name', name: 'name', width: '22%'},
            {data: 'url', name: 'url'},
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
        $("#create_rightbar_toggle").trigger('click');
    }

    function edit() {
        $("#edit_rightbar_toggle").trigger('click');
        $("#EditRightbar").hide();
        var id = $("#id_edit").val();
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.video.show') }}',
            data: {
                id: id
            },
            success: function (video) {
                $("#name_edit").val(video.name);
                $("#url_edit").val(video.url);
                $("#EditRightbar").fadeIn(250);
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function drop() {
        var selectedRows = videos.rows({selected: true});
        if (selectedRows.count() > 0) {
            $("#deleting").html(selectedRows.data()[0].name ?? '');
        }
        $("#DeleteModal").modal('show');
    }

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var name = $("#name_create").val();
        var url = $("#url_create").val();
        if (name == null || name === '') {
            toastr.warning('Video Başlığı Boş Olamaz!');
        } else if (url == null || url === '') {
            toastr.warning('URL Boş Olamaz!');
        } else {
            saveVideo({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                name: name,
                url: url,
            }, 'Yeni Video Başarıyla Oluşturuldu', 'Video Oluşturulurken Bir Hata Oluştu!', 0);
        }
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var name = $("#name_edit").val();
        var url = $("#url_edit").val();

        if (id == null || id === '') {
            toastr.warning('Sistemsel Bir Sorun Oluştu. Sayfayı Yenileyip Tekrar Deneyin.');
        } else if (name == null || name === '') {
            toastr.warning('Video Başlığı Boş Olamaz!');
        } else if (url == null || url === '') {
            toastr.warning('URL Boş Olamaz!');
        } else {
            saveVideo({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                id: id,
                name: name,
                url: url,
            }, 'Video Başarıyla Güncellendi', 'Video Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    DeleteButton.click(function () {
        $("#DeleteModal").modal('hide');
        var id = $("#id_edit").val();
        $.ajax({
            type: 'delete',
            url: '{{ route('ajax.video.drop') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            },
            success: function () {
                toastr.success('Başarıyla Silindi');
                videos.ajax.reload().draw();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Silinirken Sistemsel Bir Hata Oluştu!');
            }
        });
    });

    function saveVideo(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.video.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#create_rightbar_toggle").click();
                } else if (direction === 1) {
                    $("#edit_rightbar_toggle").click();
                }
                var currentPage = videos.page.info().page;
                videos.ajax.reload().page(currentPage).draw('page');
            },
            error: function (error) {
                toastr.error(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = videos.rows({selected: true});
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

    $('#videos tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            videos.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#videosCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            videos.rows().deselect();
        }
    });

</script>
