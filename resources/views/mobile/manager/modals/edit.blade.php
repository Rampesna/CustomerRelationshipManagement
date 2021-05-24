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
                                <label for="customer_id_edit">Müşteri Seçimi</label>
                                <select id="customer_id_edit" class="form-control">

                                </select>
                            </div>
                        </div>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="UpdateButton">Güncelle</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                </div>
            </form>
        </div>
    </div>
</div>
