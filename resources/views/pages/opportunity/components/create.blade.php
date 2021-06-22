<div id="CreateRightbar" style="width: 1500px" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="create_rightbar_toggle">
    <form id="CreateForm">
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
                            <label for="customer_id_create">Müşteri Seçimi</label>
                            <select id="customer_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="name_create">Müşteri Ünvanı</label>
                            <input type="text" id="name_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="email_create">E-posta Adresi</label>
                            <input type="text" id="email_create" class="form-control email-input-mask">
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="form-group">
                            <label for="domestic_create">Yerli / Yabancı</label>
                            <select id="domestic_create" class="form-control">
                                <option value="0" selected>Yerli</option>
                                <option value="1">Yabancı</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="row">
                            <div class="col-xl-6 mr-0">
                                <div class="form-group">
                                    <label for="country_id_create">Ülke</label>
                                    <select id="country_id_create" class="form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="phone_number_create">Telefon</label>
                                    <input type="text" id="phone_number_create" class="form-control mobile-phone-number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="province_id_create">Şehir</label>
                                    <select id="province_id_create" class="form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="district_id_create">İlçe</label>
                                    <select id="district_id_create" class="form-control">

                                    </select>
                                </div>
                            </div>
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
                            <label for="foundation_date_create">Firma Kuruluş Tarihi</label>
                            <input type="date" id="foundation_date_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="manager_name_create">Yetkili Ad Soyad</label>
                            <input type="text" id="manager_name_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="manager_email_create">Yetkili E-posta Adresi</label>
                            <input type="text" id="manager_email_create" class="form-control email-input-mask">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="manager_phone_number_create">Yetkili Telefonu</label>
                            <input type="text" id="manager_phone_number_create" class="form-control mobile-phone-number">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="date_create">Fırsat Tarihi</label>
                            <input type="date" id="date_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="form-group">
                                    <label for="price_create">Tutar</label>
                                    <input type="text" id="price_create" class="form-control decimal">
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label for="currency_create">Döviz</label>
                                    <select id="currency_create" class="form-control">
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
                            <label for="priority_id_create">Öncelik Durumu</label>
                            <select id="priority_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="access_type_id_create">Erişim Türü</label>
                            <select id="access_type_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="form-group">
                                    <label for="estimated_result_create">Tahmini Sonuçlanma</label>
                                    <input type="text" id="estimated_result_create" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="form-group">
                                    <label for="estimated_result_type_id_create">Sonuç Türü</label>
                                    <select id="estimated_result_type_id_create" class="form-control">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="form-group">
                                    <label for="capacity_create">Kapasite</label>
                                    <input type="text" id="capacity_create" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="form-group">
                                    <label for="capacity_type_id_create">Kapasite Türü</label>
                                    <select id="capacity_type_id_create" class="form-control">

                                    </select>
                                </div>
                            </div>
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
                            <label for="calendar_create">Takvimde Gösterilsin</label>
                            <select id="calendar_create" class="form-control">
                                <option value="0">Hayır</option>
                                <option value="1">Evet</option>
                            </select>
                        </div>
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
