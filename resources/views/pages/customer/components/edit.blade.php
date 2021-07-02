<div id="EditRightbar" style="width: 1500px" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="edit_rightbar_toggle">
    <input type="hidden" id="id_edit">
    <form id="EditForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Müşteri Düzenle</h5>
                    </div>
                </div>
                <hr>
                <div class="row mt-6 pr-7">
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
                            <label for="title_edit">Ünvan</label>
                            <input type="text" id="title_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="tax_number_edit">Vergi Numarası</label>
                            <input type="text" id="tax_number_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="tax_office_edit">Vergi Dairesi</label>
                            <input type="text" id="tax_office_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="email_edit">E-posta Adresi</label>
                            <input type="text" id="email_edit" class="form-control email-input-mask">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="row">
                            <div class="col-xl-5">
                                <div class="form-group">
                                    <label for="country_id_edit">Ülke</label>
                                    <select id="country_id_edit" class="form-control" data-live-search="true">

                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-7">
                                <div class="form-group">
                                    <label for="phone_number_edit">Telefon Numarası</label>
                                    <input type="text" id="phone_number_edit" class="form-control mobile-phone-number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="province_id_edit">Şehir</label>
                            <select id="province_id_edit" class="form-control" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="district_id_edit">İlçe</label>
                            <select id="district_id_edit" class="form-control" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="website_edit">Website Adresi</label>
                            <input type="text" id="website_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="foundation_date_edit">Kuruluş Tarihi</label>
                            <input type="date" id="foundation_date_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="form-group">
                            <label for="class_id_edit">Müşteri Sınıfı</label>
                            <select id="class_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="form-group">
                            <label for="type_id_edit">Müşteri Türü</label>
                            <select id="type_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="form-group">
                            <label for="reference_id_edit">Müşteri Referansı</label>
                            <select id="reference_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="brands_edit">Çalıştığı Firmalar</label>
                            <select id="brands_edit" class="form-control" multiple>

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="sectors_edit">Çalıştığı Sektörler</label>
                            <select id="sectors_edit" class="form-control" multiple>

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
