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
                                <label for="relation_type_create">Bağlantı Türü</label>
                                <select id="relation_type_create" class="form-control">
                                    <option value="App\Models\Opportunity">Fırsat</option>
                                    <option value="App\Models\Customer">Müşteri</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="relation_id_create">Bağlantı</label>
                                <select id="relation_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="subject_create">Konu</label>
                                <input type="text" id="subject_create" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="expiry_date_create">Geçerlilik Tarihi</label>
                                <input type="date" id="expiry_date_create" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="pay_type_id_create">Ödeme Türü</label>
                                <select id="pay_type_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="delivery_type_id_create">Teslim Türü</label>
                                <select id="delivery_type_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="currency_type_create">Döviz</label>
                                <select id="currency_type_create" class="form-control">
                                    <option value="TRY" selected>TRY</option>
                                    <option value="USD">Dolar</option>
                                    <option value="EUR">Euro</option>
                                    <option value="GBP">Sterlin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="currency_create">Kur</label>
                                <input type="text" id="currency_create" class="form-control decimal">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="status_id_create">Durum</label>
                                <select id="status_id_create" class="form-control">

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
