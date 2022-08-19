<div id="CreateRightbar" style="width: 1500px; max-width: 90%" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="create_rightbar_toggle">
    <form id="CreateForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Yeni Yetkili Oluştur</h5>
                    </div>
                </div>
                <hr>
                <div class="row mt-6">
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="customer_id_create">Müşteri Seçimi</label>
                            <select id="customer_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="name_create">Ad Soyad</label>
                            <input id="name_create" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="email_create">E-posta Adresi</label>
                            <input id="email_create" type="text" class="form-control email-input-mask">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="phone_number_create">Telefon Numarası</label>
                            <input id="phone_number_create" type="text" class="form-control mobile-phone-number">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="gender_create">Cinsiyet</label>
                            <select id="gender_create" class="form-control">
                                <option value="1">Erkek</option>
                                <option value="0">Kadın</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="birth_date_create">Doğum Tarihi</label>
                            <input id="birth_date_create" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="department_id_create">Departman</label>
                            <select id="department_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="title_id_create">Ünvan</label>
                            <select id="title_id_create" class="form-control">

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
