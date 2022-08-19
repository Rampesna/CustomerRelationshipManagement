<div id="EditRightbar" style="width: 1500px; max-width: 90%" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="edit_rightbar_toggle">
    <input type="hidden" id="id_edit">
    <form id="EditForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Stok Düzenle</h5>
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
                            <label for="code_edit">Stok Kodu</label>
                            <input type="text" id="code_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="name_edit">Stok Adı</label>
                            <input type="text" id="name_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="short_edit">Stok Kısa Adı</label>
                            <input type="text" id="short_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="wholesale_vat_edit">Toptan KDV</label>
                            <input type="text" id="wholesale_vat_edit" class="form-control decimal">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="retail_vat_edit">Perakende KDV</label>
                            <input type="text" id="retail_vat_edit" class="form-control decimal">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="unit_type_id_edit">Birim</label>
                            <select id="unit_type_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="unit_price_edit">Birim Fiyat</label>
                            <input type="text" id="unit_price_edit" class="form-control decimal">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="currency_type_edit">Döviz Türü</label>
                            <select id="currency_type_edit" class="form-control">
                                <option value="TRY" selected>TRY</option>
                                <option value="USD">Dolar</option>
                                <option value="EUR">Euro</option>
                                <option value="GBP">Sterlin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="type_id_edit">Stok Türü</label>
                            <select id="type_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="status_id_edit">Durumu</label>
                            <select id="status_id_edit" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="amount_edit">Stok</label>
                            <input type="text" id="amount_edit" class="form-control decimal">
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
