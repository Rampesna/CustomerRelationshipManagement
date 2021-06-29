<div class="modal fade" id="EditSendOpportunityEmailModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" rows="20">{!! file_get_contents(base_path('resources/views/emails/new-opportunity.blade.php')) !!}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="UpdateSendOpportunityEmailButton">Güncelle</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
            </div>
        </div>
    </div>
</div>
