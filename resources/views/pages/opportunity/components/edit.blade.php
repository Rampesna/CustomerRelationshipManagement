<div id="EditRightbar" style="width: 1500px" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="edit_rightbar_toggle">
    <input type="hidden" id="id_edit">
    <form id="EditForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Yeni Fırsat Oluştur</h5>
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
                            <label for="customer_id_edit">Müşteri Seçimi</label>
                            <select id="customer_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="name_edit">Müşteri Ünvanı</label>
                            <input type="text" id="name_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="email_edit">E-posta Adresi</label>
                            <input type="text" id="email_edit" class="form-control email-input-mask">
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="form-group">
                            <label for="domestic_edit">Yerli / Yabancı</label>
                            <select id="domestic_edit" class="form-control">
                                <option value="0" selected>Yerli</option>
                                <option value="1">Yabancı</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="row">
                            <div class="col-xl-6 mr-0">
                                <div class="form-group">
                                    <label for="country_id_edit">Ülke</label>
                                    <select id="country_id_edit" class="form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="phone_number_edit">Telefon</label>
                                    <input type="text" id="phone_number_edit" class="form-control mobile-phone-number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="province_id_edit">Şehir</label>
                                    <select id="province_id_edit" class="form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="district_id_edit">İlçe</label>
                                    <select id="district_id_edit" class="form-control">

                                    </select>
                                </div>
                            </div>
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
                            <label for="foundation_date_edit">Firma Kuruluş Tarihi</label>
                            <input type="date" id="foundation_date_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="manager_name_edit">Yetkili Ad Soyad</label>
                            <input type="text" id="manager_name_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="manager_email_edit">Yetkili E-posta Adresi</label>
                            <input type="text" id="manager_email_edit" class="form-control email-input-mask">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="manager_phone_number_edit">Yetkili Telefonu</label>
                            <input type="text" id="manager_phone_number_edit" class="form-control mobile-phone-number">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="date_edit">Fırsat Tarihi</label>
                            <input type="date" id="date_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="form-group">
                                    <label for="price_edit">Tutar</label>
                                    <input type="text" id="price_edit" class="form-control decimal">
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label for="currency_edit">Döviz</label>
                                    <select id="currency_edit" class="form-control">
                                        <option value="TRY" selected>TRY</option>
                                        <option value="USD">Dolar</option>
                                        <option value="EUR">Euro</option>
                                        <option value="GBP">Sterlin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="priority_id_edit">Öncelik Durumu</label>
                            <select id="priority_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="access_type_id_edit">Erişim Türü</label>
                            <select id="access_type_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="form-group">
                                    <label for="estimated_result_edit">Tahmini Sonuçlanma</label>
                                    <input type="text" id="estimated_result_edit" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="form-group">
                                    <label for="estimated_result_type_id_edit">Sonuç Türü</label>
                                    <select id="estimated_result_type_id_edit" class="form-control">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="form-group">
                                    <label for="capacity_edit">Kapasite</label>
                                    <input type="text" id="capacity_edit" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="form-group">
                                    <label for="capacity_type_id_edit">Kapasite Türü</label>
                                    <select id="capacity_type_id_edit" class="form-control">

                                    </select>
                                </div>
                            </div>
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
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="calendar_edit">Takvimde Gösterilsin</label>
                            <select id="calendar_edit" class="form-control">
                                <option value="0">Hayır</option>
                                <option value="1">Evet</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="description_edit">Açıklamalar</label>
                            <textarea class="form-control" rows="4" id="description_edit"></textarea>
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
