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
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="subject_create">Konu</label>
                                <input type="text" id="subject_create" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="start_date_create">Başlangıç Tarihi</label>
                                <input type="date" id="start_date_create" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="end_date_create">Bitiş Tarihi</label>
                                <input type="date" id="end_date_create" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="meet_reason_id_create">Görüşme Nedeni</label>
                                <select id="meet_reason_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="priority_id_create">Öncelik Durumu</label>
                                <select id="priority_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">

                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="notes_create">Açıklamalar</label>
                                <textarea class="form-control" rows="4" id="notes_create"></textarea>
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
