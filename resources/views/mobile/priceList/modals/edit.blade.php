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
                                <label for="company_id_edit">Firma Seçimi</label>
                                <select id="company_id_edit" class="form-control">
                                    <option selected hidden disabled></option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="user_id_edit">Temsilci</label>
                                <select id="user_id_edit" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="name_edit">Fiyat Listesi Adı</label>
                                <input type="text" id="name_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="status_id_edit">Durum</label>
                                <select id="status_id_edit" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="start_date_edit">Başlangıç Tarihi</label>
                                <input type="date" id="start_date_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="end_date_edit">Bitiş Tarihi</label>
                                <input type="date" id="end_date_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3"></div>
                        <div class="col-xl-3"></div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="description_edit">Açıklamalar</label>
                                <textarea id="description_edit" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-8">
                            <h5>Malzemeler<i class="ml-2 fa fa-plus-circle text-success cursor-pointer" id="priceListItemCreateIcon"></i></h5>
                        </div>
                        <div class="col-xl-4 text-right">
                            <i class="fa fa-trash text-danger cursor-pointer" id="priceListItemDeleteIcon" style="display: none"></i>
                        </div>
                    </div>
                    <div class="row mt-6">
                        <input type="hidden" id="price_list_item_id_edit">
                        <div class="col-xl-12">
                            <table class="table table-bordered table-hover" id="priceListItems">
                                <thead>
                                <tr>
                                    <th>Mal / Hizmet</th>
                                    <th>Birim Fiyat</th>
                                    <th>KDV Oranı</th>
                                    <th>Döviz Türü</th>
                                </tr>
                                </thead>
                            </table>
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
