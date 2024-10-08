<div id="EditRightbar" style="width: 1500px; max-width: 90%" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="edit_rightbar_toggle">
    <input type="hidden" id="id_edit">
    <div class="offcanvas-content">
        <div class="offcanvas-wrapper mb-5 scroll-pull">
            <div class="row">
                <div class="col-xl-10">
                    <h5>Numuneyi Düzenle</h5>
                </div>
            </div>
            <hr>
            <div class="row mt-6">
                <input type="hidden" id="company_id_edit" value="{{ $customer->company_id }}">
                <input type="hidden" id="relation_type_edit" value="App\Models\Customer">
                <input type="hidden" id="relation_id_edit" value="{{ $customer->id }}">
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="user_id_edit">Temsilci Seçimi</label>
                        <select id="user_id_edit" class="form-control">

                        </select>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="subject_edit">Konu</label>
                        <input type="text" id="subject_edit" class="form-control">
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="date_edit">Tarih</label>
                        <input type="date" id="date_edit" class="form-control">
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="status_id_edit">Durum</label>
                        <select id="status_id_edit" class="form-control">

                        </select>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="cargo_company_id_edit">Kargo Firması</label>
                        <select id="cargo_company_id_edit" class="form-control">

                        </select>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="cargo_tracking_number_edit">Kargo Takip Numarası</label>
                        <input type="text" id="cargo_tracking_number_edit" class="form-control">
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="bus_company_edit">Otobüs Firması</label>
                        <input type="text" id="bus_company_edit" class="form-control">
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="car_plate_edit">Araç Plakası</label>
                        <input type="text" id="car_plate_edit" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-8">
                <h5>Malzemeler<i class="ml-2 fa fa-plus-circle text-success cursor-pointer" id="sampleItemCreateIcon"></i></h5>
            </div>
            <div class="col-xl-4 text-right">
                <i class="fa fa-trash text-danger cursor-pointer" id="sampleItemDeleteIcon"></i>
            </div>
        </div>
        <div class="row mt-6">
            <input type="hidden" id="sample_item_id_edit">
            <div class="col-xl-12">
                <table class="table table-bordered table-hover" id="sampleItems">
                    <thead>
                    <tr>
                        <th>Stok</th>
                        <th>Miktar</th>
                        <th>Birim</th>
                    </tr>
                    </thead>
                </table>
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
</div>
