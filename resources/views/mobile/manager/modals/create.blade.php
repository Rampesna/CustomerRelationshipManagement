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
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="CreateButton">Oluştur</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                </div>
            </form>
        </div>
    </div>
</div>
