<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>
    function format(data) {
        var rows = '';
        $.each(data, function (index) {
            rows = rows + '<tr>' +
                '<td>' + data[index].sth_stok_kod + '</td>' +
                '<td>' + data[index].sth_stok_isim + '</td>' +
                '<td>' + numberFormatter(data[index].sth_miktar) + '</td>' +
                '<td>' + numberFormatter(data[index].sth_tutar) + ' TL</td>' +
                '<td>' + numberFormatter(data[index].sth_miktar * data[index].sth_tutar) + ' TL</td>' +
                '<td>' + numberFormatter(data[index].sth_vergi) + ' TL</td>' +
                '<td class="text-right">' + numberFormatter(data[index].sth_toplam) + ' TL</td>' +
                '</tr>';
        });
        return '<table class="table">' +
            '<thead>' +
            '<tr>' +
            '<th>Stok Kodu</th>' +
            '<th>Stok Adı</th>' +
            '<th>Miktar</th>' +
            '<th>Birim Fiyat</th>' +
            '<th>Tutar</th>' +
            '<th>KDV</th>' +
            '<th class="text-right">Toplam Tutar</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>' +
            rows +
            '</tbody>' +
            '</table>';
    }

    function numberFormatter(num) {
        return (
            num
                .toFixed(2)
                .replace('.', ',')
                .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        )
    }

    var purchases = $('#purchases').DataTable({
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
            }
        },
        dom: 'Brtipl',

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
            }
        ],

        initComplete: function () {
            var r = $('#purchases tfoot tr');
            $('#purchases thead').append(r);
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

        order: [[ 0, "desc" ]],
        responsive: true,
        select: false
    });

    purchases.on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = purchases.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(format(tr.data('child-value'))).show();
            tr.addClass('shown');
        }
    });
</script>
