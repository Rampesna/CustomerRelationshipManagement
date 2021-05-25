<div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="CreateForm">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Oluştur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="companies_create">Yetkili Olacağı Firmalar</label>
                                <select id="companies_create" class="form-control" multiple>

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="name_create">Ad Soyad</label>
                                <input type="text" id="name_create" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="email_create">E-posta Adresi</label>
                                <input type="text" id="email_create" class="form-control email-input-mask">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="phone_number_create">Telefon Numarası</label>
                                <input type="text" id="phone_number_create" class="form-control mobile-phone-number">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="role_id_create">Rol</label>
                                <select id="role_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="password_create">Kullanıcı Şifresi</label>
                                <input type="password" id="password_create" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="CreateButton">Oluştur</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                </div>
            </form>
        </div>
    </div>
</div>
