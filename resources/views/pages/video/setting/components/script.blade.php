<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

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
            url: '{{ route('ajax.video.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    listing: listing.val()
                });
            },
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'role_id', name: 'role_id'},
        ],
        responsive: true,
        stateSave: true,
        select: 'single'
    });

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
