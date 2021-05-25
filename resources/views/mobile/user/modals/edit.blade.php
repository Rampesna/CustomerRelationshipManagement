<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="EditForm">
                <div class="modal-header">
                    <h5 class="modal-title">Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="id_edit">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="UpdateButton">Güncelle</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                </div>
            </form>
        </div>
    </div>
</div>
