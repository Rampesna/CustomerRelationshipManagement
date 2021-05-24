<div class="modal fade" id="LogoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:500px;">
        <div class="modal-content" style="margin-top: 50%">
            <div class="modal-header">
                <h5 class="modal-title">Çıkış Yap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Çıkış yapmak istediğinize emin misiniz?
                </p>
                <form id="logout-form" action="{{ route('logout')}}" method="post" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-success">Çıkış Yap</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Vazgeç</button>
            </div>
        </div>
    </div>
</div>
