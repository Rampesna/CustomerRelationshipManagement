<div id="CreateRightbar" style="width: 1500px; max-width: 90%" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="create_rightbar_toggle">
    <form id="CreateForm">
        <div class="offcanvas-content">
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Yeni Stok Oluştur</h5>
                    </div>
                </div>
                <hr>
                <div class="row mt-6">
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
                            <label for="code_create">Stok Kodu</label>
                            <input type="text" id="code_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="name_create">Stok Adı</label>
                            <input type="text" id="name_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="short_create">Stok Kısa Adı</label>
                            <input type="text" id="short_create" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="wholesale_vat_create">Toptan KDV</label>
                            <input type="text" id="wholesale_vat_create" class="form-control decimal">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="retail_vat_create">Perakende KDV</label>
                            <input type="text" id="retail_vat_create" class="form-control decimal">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="unit_type_id_create">Birim</label>
                            <select id="unit_type_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="unit_price_create">Birim Fiyat</label>
                            <input type="text" id="unit_price_create" class="form-control decimal">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="currency_type_create">Döviz Türü</label>
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
                            <label for="type_id_create">Stok Türü</label>
                            <select id="type_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="status_id_create">Durumu</label>
                            <select id="status_id_create" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="amount_create">Stok</label>
                            <input type="text" id="amount_create" class="form-control decimal">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="offcanvas-footer">
                <div class="row">
                    <div class="col-xl-12 text-right">
                        <button type="button" class="btn btn-success" id="CreateButton">Oluştur</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
