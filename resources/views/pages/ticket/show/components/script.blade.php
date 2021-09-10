<script>

    function setTicketStatus(status_id) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.ticket.setStatus') }}',
            data: {
                _token: '{{ csrf_token() }}',
                ticket_id: '{{ $ticket->id }}',
                status_id: status_id,
            },
            success: function () {
                if (parseInt(status_id) === 3) {
                    toastr.success('Talep Sonlandırıldı!');
                } else if (parseInt(status_id) === 4) {
                    toastr.success('Talep İptal Edildi!');
                } else {
                    toastr.info('Kaydedildi!');
                }
                $(location).attr('href', '{{ route('ticket.index') }}');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Talep Durumu Güncellenirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin!');
            }
        });
    }

</script>
