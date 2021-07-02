<script>
    @if(session()->has('type') && session()->has('data'))
    toastr.{{ session()->get('type') }}("{{ session()->get('data') }}");
    @endif

    $('#SelectedCompany').change(function () {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.setSelectedCompany') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: $(this).val(),
                auth_user_id: '{{ auth()->user()->id() }}'
            },
            error: function (error) {
                console.log(error)
            }
        });
    });
</script>
