<div id="EditRightbar" style="width: 1500px; max-width: 90%" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="edit_rightbar_toggle">
    <input type="hidden" id="id_edit">
    <form id="EditForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Yetkili Düzenle</h5>
                    </div>
                </div>
                <hr>
                <div class="row mt-6">
                    <input type="hidden" id="customer_id_edit" value="{{ $customer->id }}">
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="name_edit">Ad Soyad</label>
                            <input id="name_edit" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="email_edit">E-posta Adresi</label>
                            <input id="email_edit" type="text" class="form-control email-input-mask">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="phone_number_edit">Telefon Numarası</label>
                            <input id="phone_number_edit" type="text" class="form-control mobile-phone-number">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="gender_edit">Cinsiyet</label>
                            <select id="gender_edit" class="form-control">
                                <option value="1">Erkek</option>
                                <option value="0">Kadın</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="birth_date_edit">Doğum Tarihi</label>
                            <input id="birth_date_edit" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="department_id_edit">Departman</label>
                            <select id="department_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="title_id_edit">Ünvan</label>
                            <select id="title_id_edit" class="form-control">

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
