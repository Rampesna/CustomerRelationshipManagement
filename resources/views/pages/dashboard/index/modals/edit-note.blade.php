<div class="modal fade" id="EditNoteModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Not Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="EditNoteForm" class="modal-body">
                <input type="hidden" id="note_id_edit">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="edit_note_title">Not Başlığı</label>
                            <input type="text" class="form-control" id="edit_note_title">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="edit_note_date">Not Tarihi</label>
                            <input type="datetime-local" id="edit_note_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="edit_note_company_id">Firma</label>
                            <select id="edit_note_company_id" class="form-control">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="edit_note_global">Görüntülenme Türü</label>
                            <select id="edit_note_global" class="form-control">
                                <option value="0">Sadece Ben</option>
                                <option value="1">Tüm Kullanıcılar</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="edit_note_description">Not İçeriği</label>
                            <textarea id="edit_note_description" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="UpdateNoteButton">Güncelle</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Vazgeç</button>
            </div>
        </div>
    </div>
</div>
