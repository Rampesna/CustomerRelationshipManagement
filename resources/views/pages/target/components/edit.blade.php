<div id="EditRightbar" style="width: 1100px" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="edit_rightbar_toggle">
    <input type="hidden" id="id_edit">
    <form id="EditForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Hedefi Düzenle</h5>
                    </div>
                </div>
                <hr>
                <div class="row mt-6">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="user_id_edit">Temsilci Seçimi</label>
                            <select id="user_id_edit" class="form-control">

                            </select>
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
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="type_edit">Hedef Türü</label>
                            <select id="type_edit" class="form-control">
                                <option value="opportunity">Fırsat</option>
                                <option value="activity">Aktivite</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="target_edit">Hedef</label>
                            <input type="text" id="target_edit" class="form-control decimal">
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
