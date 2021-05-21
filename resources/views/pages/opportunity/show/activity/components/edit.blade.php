<div id="EditRightbar" style="width: 1500px" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="edit_rightbar_toggle">
    <input type="hidden" id="id_edit">
    <form id="EditForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Aktiviyi Düzenle</h5>
                    </div>
                </div>
                <hr>
                <div class="row mt-6">
                    <input type="hidden" id="company_id_edit" value="{{ $opportunity->company_id }}">
                    <input type="hidden" id="relation_type_edit" value="App\Models\Opportunity">
                    <input type="hidden" id="relation_id_edit" value="{{ $opportunity->id }}">
                    <div class="col-xl-3">
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
            <hr>
            <div class="offcanvas-footer">
                <div class="row">
                    <div class="col-xl-12 text-right">
                        <button type="button" class="btn btn-success" id="UpdateButton">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
