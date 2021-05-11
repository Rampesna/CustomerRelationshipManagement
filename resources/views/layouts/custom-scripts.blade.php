<script>
    @if(session()->has('type') && session()->has('data'))
    toastr.{{ session()->get('type') }}("{{ session()->get('data') }}");
    @endif
</script>
