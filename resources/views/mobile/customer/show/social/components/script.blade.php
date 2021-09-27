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

    var socials = $('#socials').DataTable({
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
            var r = $('#socials tfoot tr');
            $('#socials thead').append(r);
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
            url: '{{ route('ajax.social.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    relation_type: 'App\\Models\\Customer',
                    relation_id: '{{ $customer->id }}',
                });
            },
        },
        columns: [
            {data: 'id', name: 'id', width: '5%'},
            {data: 'link', name: 'link'},
        ],

        responsive: true,
        stateSave: true,
        select: 'single'
    });

    socials.on('select', function (e, dt, type, indexes) {
        var selectedRows = socials.rows({selected: true});
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
        $("#CreateModal").modal('show');
    }

    function edit() {
        $("#EditModal").modal('show');
        $("#EditRightbar").hide();

        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.social.show') }}',
            data: {
                id: id
            },
            success: function (social) {
                $("#link_edit").val(social.link);
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
        var link = $("#link_create").val();

        if (link == null || link === '') {
            toastr.warning('Link Boş Bırakılamaz!');
        } else {
            saveSocial({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                relation_type: relation_type,
                relation_id: relation_id,
                link: link,
            }, 'Yeni Sosyal Medya Hesabı Başarıyla Oluşturuldu', 'Sosyal Medya Hesabı Oluşturulurken Bir Hata Oluştu!', 0);
        }
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var relation_type = 'App\\Models\\Customer';
        var relation_id = '{{ $customer->id }}';
        var link = $("#link_edit").val();

        if (link == null || link === '') {
            toastr.warning('Link Boş Bırakılamaz!');
        } else {
            saveSocial({
                _token: '{{ csrf_token() }}',
                id: id,
                auth_user_id: auth_user_id,
                relation_type: relation_type,
                relation_id: relation_id,
                link: link,
            }, 'Sosyal Medya Hesabı Başarıyla Güncellendi', 'Sosyal Medya Hesabı Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    function saveSocial(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.social.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                if (direction === 0) {
                    $("#CreateModal").modal('hide');
                } else if (direction === 1) {
                    $("#EditModal").modal('hide');
                }
                socials.ajax.reload().draw();
            },
            error: function (error) {
                toastr.error(errorMessage);
                console.log(error)
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = socials.rows({selected: true});
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

    $('#socials tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            socials.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#socialsCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            socials.rows().deselect();
        }
    });
</script>
