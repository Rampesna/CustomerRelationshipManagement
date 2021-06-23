<div id="CreateRightbar" style="width: 1500px" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="create_rightbar_toggle">
    <form id="CreateForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Yeni Müşteri Oluştur</h5>
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
                            <label for="title_create">Ünvan</label>
                            <input type="text" id="title_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="tax_number_create">Vergi Numarası</label>
                            <input type="text" id="tax_number_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="tax_office_create">Vergi Dairesi</label>
                            <input type="text" id="tax_office_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="email_create">E-posta Adresi</label>
                            <input type="text" id="email_create" class="form-control email-input-mask">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="row">
                            <div class="col-xl-5">
                                <div class="form-group">
                                    <label for="country_id_create">Ülke</label>
                                    <select id="country_id_create" class="form-control" data-live-search="true">

                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-7">
                                <div class="form-group">
                                    <label for="phone_number_create">Telefon Numarası</label>
                                    <input type="text" id="phone_number_create" class="form-control mobile-phone-number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="province_id_create">Şehir</label>
                            <select id="province_id_create" class="form-control" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="district_id_create">İlçe</label>
                            <select id="district_id_create" class="form-control" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="website_create">Website Adresi</label>
                            <input type="text" id="website_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="foundation_date_create">Kuruluş Tarihi</label>
                            <input type="date" id="foundation_date_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="form-group">
                            <label for="class_id_create">Müşteri Sınıfı</label>
                            <select id="class_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="form-group">
                            <label for="type_id_create">Müşteri Türü</label>
                            <select id="type_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="form-group">
                            <label for="reference_id_create">Müşteri Referansı</label>
                            <select id="reference_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="brands_create">Çalıştığı Firmalar</label>
                            <select id="brands_create" class="form-control" multiple>

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="sectors_create">Çalıştığı Sektörler</label>
                            <select id="sectors_create" class="form-control" multiple>

                            </select>
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
