<div id="EditRightbar" style="width: 1500px" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="edit_rightbar_toggle">
    <input type="hidden" id="id_edit">
    <form id="EditForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Teklifi Düzenle</h5>
                    </div>
                </div>
                <hr>
                <div class="row mt-6">
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="company_id_edit">Firma Seçimi</label>
                            <select id="company_id_edit" class="form-control">
                                <option selected hidden disabled></option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="user_id_edit">Temsilci Seçimi</label>
                            <select id="user_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="relation_type_edit">Bağlantı Türü</label>
                            <select id="relation_type_edit" class="form-control">
                                <option value="App\Models\Opportunity">Fırsat</option>
                                <option value="App\Models\Customer">Müşteri</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="relation_id_edit">Bağlantı</label>
                            <select id="relation_id_edit" class="form-control">

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
                            <label for="expiry_date_edit">Geçerlilik Tarihi</label>
                            <input type="date" id="expiry_date_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="pay_type_id_edit">Ödeme Türü</label>
                            <select id="pay_type_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="delivery_type_id_edit">Teslim Türü</label>
                            <select id="delivery_type_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="currency_type_edit">Döviz</label>
                            <select id="currency_type_edit" class="form-control">
                                <option value="TRY" selected>TRY</option>
                                <option value="USD">Dolar</option>
                                <option value="EUR">Euro</option>
                                <option value="GBP">Sterlin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="currency_edit">Kur</label>
                            <input type="text" id="currency_edit" class="form-control decimal">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="status_id_edit">Durum</label>
                            <select id="status_id_edit" class="form-control">

                            </select>
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
