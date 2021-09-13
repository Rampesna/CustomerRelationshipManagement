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

    var CreateButton = $('#CreateButton');
    var DeleteButton = $('#DeleteButton');

    var idCreate = $('#id_create');
    var guidCreate = $('#guid_create');

    var matches = $('#matches').DataTable({
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
            var r = $('#matches tfoot tr');
            $('#matches thead').append(r);
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
            url: '{{ route('ajax.erpMatch.datatable') }}',
            data: function (d) {
                return $.extend({}, d, {
                    relation_type: 'App\\Models\\District'
                });
            }
        },

        columns: [
            {data: 'relation_id', name: 'relation_id'},
            {data: 'guid', name: 'guid', sortable: false},
        ],
        responsive: true,
        select: 'single'
    });

    function drop() {
        var selectedRows = matches.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].r_id;
            var guid = selectedRows.data()[0].r_guid;
            $("#id_edit").val(id);
            $("#guid_edit").val(guid);
        }
        $("#DeleteModal").modal('show');
    }

    function getDistricts() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.district.all') }}',
            data: {},
            success: function (response) {
                idCreate.empty();
                idCreate.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response, function (i, data) {
                    idCreate.append(`<option value="${data.id}">${data.name}</option>`);
                });
                idCreate.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getGuidDistricts() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.district.erp.index') }}',
            data: {},
            success: function (response) {
                guidCreate.empty();
                guidCreate.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response, function (i, data) {
                    guidCreate.append(`<option value="${data.ilceler_Guid}">${data.ilceler_ilceadi}</option>`);
                });
                guidCreate.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    getDistricts();
    getGuidDistricts();

    CreateButton.click(function () {
        var relation_id = idCreate.val();
        var guid = guidCreate.val();

        if (relation_id == null || relation_id === '') {
            toastr.warning('CRM İlçe Seçmediniz');
        } else if (guid == null || guid === '') {
            toastr.warning('Ticari Program İlçe Seçmediniz!');
        } else {
            saveMatch({
                relation_type: 'App\\Models\\District',
                relation_id: relation_id,
                guid: guid
            });
        }
    });

    DeleteButton.click(function () {
        var relation_type = 'App\\Models\\District';
        var relation_id = $('#id_edit').val();
        var guid = $('#guid_edit').val();

        $.ajax({
            type: 'delete',
            url: '{{ route('ajax.erpMatch.drop') }}',
            data: {
                _token: '{{ csrf_token() }}',
                relation_type: relation_type,
                relation_id: relation_id,
                guid: guid
            },
            success: function (response) {
                if (response.status === 404) {
                    toastr.warning(response.message);
                } else {
                    $('#DeleteModal').modal('hide');
                    toastr.success(response.message);
                    var currentPage = matches.page.info().page;
                    matches.ajax.reload().page(currentPage).draw('page');
                }
            },
            error: function (error) {
                toastr.error('Eşleşme Silinirken Sistemsel Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin!');
                console.log(error);
            }
        });
    });

    function saveMatch(data) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.erpMatch.save') }}',
            data: data,
            success: function (response) {
                if (response.status === 200) {
                    toastr.success(response.message);
                    var currentPage = matches.page.info().page;
                    matches.ajax.reload().page(currentPage).draw('page');
                } else {
                    toastr.warning(response.message);
                }
            },
            error: function (error) {
                toastr.success('Eşleşme Kaydedilirken Sistemsel Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin!');
                console.log(error);
            }
        });
    }

    $('body').on('contextmenu', function (e) {
        var selectedRows = matches.rows({selected: true});
        if (selectedRows.count() > 0) {
            var top = e.pageY - 10;
            var left = e.pageX - 10;
            $("#context-menu").css({
                display: "block",
                top: top,
                left: left
            });
        } else {
            $("#EditingContexts").hide();
        }

        return false;
    }).on("click", function () {
        $("#context-menu").hide();
    }).on('focusout', function () {
        $("#context-menu").hide();
    });

    $('#matches tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            matches.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#matchesCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            matches.rows().deselect();
        }
    });
</script>
