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

    var customerIdCreate = $("#customer_id_create");
    var departmentIdCreate = $("#department_id_create");
    var titleIdCreate = $("#title_id_create");

    var customerIdEdit = $("#customer_id_edit");
    var departmentIdEdit = $("#department_id_edit");
    var titleIdEdit = $("#title_id_edit");

    var CreateButton = $("#CreateButton");
    var UpdateButton = $("#UpdateButton");

    var comments = $('#comments').DataTable({
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
            var r = $('#comments tfoot tr');
            $('#comments thead').append(r);
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
            url: '{{ route('ajax.comment.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    relation_type: 'App\\Models\\Customer',
                    relation_id: '{{ $customer->id }}',
                });
            },
        },
        columns: [
            {data: 'id', name: 'id', width: '5%'},
            {data: 'user_id', name: 'user_id', width: '10%'},
            {data: 'comment', name: 'comment'},
        ],

        responsive: true,
        stateSave: true,
        select: 'single'
    });

    comments.on('select', function (e, dt, type, indexes) {
        var selectedRows = comments.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id.replace('#', '');
            $("#id_edit").val(id);
            $("#EditButton").show();
        } else {
            $("#EditButton").hide();
        }
    }).on('deselect', function (e, dt, type, indexes) {
        $("#EditButton").hide();
    });

    function create() {
        $("#CreateForm").trigger('reset');
        $("#CreateModal").modal('show');
    }

    function edit() {
        $("#EditModal").modal('show');
        $("#EditRightbar").hide();

        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.comment.show') }}',
            data: {
                id: id
            },
            success: function (comment) {
                if (comment.user_id != '{{ auth()->user()->id() }}') {
                    $("#edit_rightbar_toggle").trigger('click');
                    toastr.warning('Size Ait Olmayan Bir Yorumu Düzenleyemezsiniz!');
                } else {
                    $("#comment_edit").val(comment.comment);
                }
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function drop() {

    }

    CreateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var relation_type = 'App\\Models\\Customer';
        var relation_id = '{{ $customer->id }}';
        var user_id = '{{ auth()->user()->id() }}';
        var comment = $("#comment_create").val();

        if (comment == null || comment === '') {
            toastr.warning('Yorum Boş Olamaz!');
        } else {
            saveComment({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                relation_type: relation_type,
                relation_id: relation_id,
                user_id: user_id,
                comment: comment,
            }, 'Yeni Yorum Başarıyla Oluşturuldu', 'Yorum Oluşturulurken Bir Hata Oluştu!', 0);
        }
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var relation_type = 'App\\Models\\Customer';
        var relation_id = '{{ $customer->id }}';
        var user_id = '{{ auth()->user()->id() }}';
        var comment = $("#comment_edit").val();

        if (comment == null || comment === '') {
            toastr.warning('Yorum Boş Olamaz!');
        } else {
            saveComment({
                _token: '{{ csrf_token() }}',
                id: id,
                auth_user_id: auth_user_id,
                relation_type: relation_type,
                relation_id: relation_id,
                user_id: user_id,
                comment: comment,
            }, 'Yorum Başarıyla Güncellendi', 'Yorum Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    function saveComment(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.comment.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#CreateModal").modal('hide');
                } else if (direction === 1) {
                    $("#EditModal").modal('hide');
                }
                comments.ajax.reload().draw();
            },
            error: function (error) {
                toastr.success(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = comments.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id.replace('#', '');
            $("#id_edit").val(id);
            if (selectedRows.data()[0].user_id != '{{ auth()->user()->name() }}') {
                $("#EditingContexts").hide();
            } else {
                $("#EditingContexts").show();
            }
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

    $('#comments tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            comments.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#commentsCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            comments.rows().deselect();
        }
    });
</script>
