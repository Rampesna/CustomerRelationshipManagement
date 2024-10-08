<div id="EditRightbar" style="width: 1500px; max-width: 90%" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="edit_rightbar_toggle">
    <input type="hidden" id="id_edit">
    <form id="EditForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Fiyat Listesi Düzenle</h5>
                    </div>
                </div>
                <hr>
                <div class="row mt-6">
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
            </div>

            <div class="row">
                <div class="col-xl-8">
                    <h5>Malzemeler
                        <i class="ml-2 fa fa-plus-circle text-success cursor-pointer" id="priceListItemCreateIcon"></i>
                    </h5>
                </div>
                <div class="col-xl-4 text-right">
                    <button type="button" class="btn btn-sm btn-icon btn-danger" id="priceListItemDeleteIcon" style="display: none">
                        <i class="fa fa-trash fa-sm text-white"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-info" id="priceListItemEditIcon" style="display: none">
                        <i class="fa fa-pen fa-sm text-white"></i>
                    </button>
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
