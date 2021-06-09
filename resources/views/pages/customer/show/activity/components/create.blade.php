<div id="CreateRightbar" style="width: 1500px" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="create_rightbar_toggle">
    <form id="CreateForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Yeni Aktivite Oluştur</h5>
                    </div>
                </div>
                <hr>
                <div class="row mt-6">
                    <input type="hidden" id="company_id_create" value="{{ $customer->company_id }}">
                    <input type="hidden" id="relation_type_create" value="App\Models\Customer">
                    <input type="hidden" id="relation_id_create" value="{{ $customer->id }}">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="user_id_create">Temsilci Seçimi</label>
                            <select id="user_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="subject_create">Konu</label>
                            <input type="text" id="subject_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="start_date_create">Başlangıç Tarihi</label>
                            <input type="date" id="start_date_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="end_date_create">Bitiş Tarihi</label>
                            <input type="date" id="end_date_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="meet_reason_id_create">Görüşme Nedeni</label>
                            <select id="meet_reason_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="priority_id_create">Öncelik Durumu</label>
                            <select id="priority_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">

                    </div>
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="description_create">Açıklamalar</label>
                            <textarea class="form-control" rows="4" id="description_create"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="offcanvas-footer">
                <div class="row">
                    <div class="col-xl-12 text-right">
                        <button type="button" class="btn btn-success" id="CreateButton">Oluştur</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
