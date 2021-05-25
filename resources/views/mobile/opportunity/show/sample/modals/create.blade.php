<div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="CreateForm">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Oluştur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="company_id_create" value="{{ $opportunity->company_id }}">
                        <input type="hidden" id="relation_type_create" value="App\Models\Opportunity">
                        <input type="hidden" id="relation_id_create" value="{{ $opportunity->id }}">
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="user_id_create">Temsilci Seçimi</label>
                                <select id="user_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="subject_create">Konu</label>
                                <input type="text" id="subject_create" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="date_create">Tarih</label>
                                <input type="date" id="date_create" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="status_id_create">Durum</label>
                                <select id="status_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="cargo_company_id_create">Kargo Firması</label>
                                <select id="cargo_company_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="cargo_tracking_number_create">Kargo Takip Numarası</label>
                                <input type="text" id="cargo_tracking_number_create" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="bus_company_create">Otobüs Firması</label>
                                <input type="text" id="bus_company_create" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="car_plate_create">Araç Plakası</label>
                                <input type="text" id="car_plate_create" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="CreateButton">Oluştur</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                </div>
            </form>
        </div>
    </div>
</div>
