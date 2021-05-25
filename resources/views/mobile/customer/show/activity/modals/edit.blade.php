<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="EditForm">
                <div class="modal-header">
                    <h5 class="modal-title">Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="id_edit">
                        <input type="hidden" id="company_id_edit" value="{{ $customer->company_id }}">
                        <input type="hidden" id="relation_type_edit" value="App\Models\Customer">
                        <input type="hidden" id="relation_id_edit" value="{{ $customer->id }}">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="user_id_edit">Temsilci Seçimi</label>
                                <select id="user_id_edit" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="subject_edit">Konu</label>
                                <input type="text" id="subject_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="start_date_edit">Başlangıç Tarihi</label>
                                <input type="date" id="start_date_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="end_date_edit">Bitiş Tarihi</label>
                                <input type="date" id="end_date_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="meet_reason_id_edit">Görüşme Nedeni</label>
                                <select id="meet_reason_id_edit" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="priority_id_edit">Öncelik Durumu</label>
                                <select id="priority_id_edit" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">

                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="notes_edit">Açıklamalar</label>
                                <textarea class="form-control" rows="4" id="notes_edit"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="UpdateButton">Güncelle</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                </div>
            </form>
        </div>
    </div>
</div>
