<div id="EditRightbar" style="width: 1500px; max-width: 90%" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="edit_rightbar_toggle">
    <input type="hidden" id="id_edit">
    <form id="EditForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Kullanıcı Düzenle</h5>
                    </div>
                </div>
                <hr>
                <div class="row mt-6">
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="companies_edit">Yetkili Olacağı Firmalar</label>
                            <select id="companies_edit" class="form-control" multiple>

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="name_edit">Ad Soyad</label>
                            <input type="text" id="name_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="email_edit">E-posta Adresi</label>
                            <input type="text" id="email_edit" class="form-control email-input-mask">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="phone_number_edit">Telefon Numarası</label>
                            <input type="text" id="phone_number_edit" class="form-control mobile-phone-number">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="role_id_edit">Rol</label>
                            <select id="role_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="password_edit">Yeni Kullanıcı Şifresi</label>
                            <input type="password" id="password_edit" class="form-control">
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
