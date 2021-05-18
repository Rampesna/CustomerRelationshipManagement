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
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="company_id_create">Firma Seçimi</label>
                            <select id="company_id_create" class="form-control">
                                <option selected hidden disabled></option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="user_id_create">Temsilci Seçimi</label>
                            <select id="user_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="relation_type_create">Bağlantı Türü</label>
                            <select id="relation_type_create" class="form-control">
                                <option value="App\Models\Opportunity">Fırsat</option>
                                <option value="App\Models\Customer">Müşteri</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="relation_id_create">Bağlantı</label>
                            <select id="relation_id_create" class="form-control">

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
