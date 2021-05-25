<div id="CreateRightbar" style="width: 1500px" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="create_rightbar_toggle">
    <div class="offcanvas-content">
        <div class="offcanvas-wrapper mb-5 scroll-pull">
            <form id="CreateForm">
                <div class="row">
                    <div class="col-xl-10">
                        <h5>Yeni Teklif Oluştur</h5>
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
            </form>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-8">
                <h5>Malzemeler<i class="ml-2 fa fa-plus-circle text-success cursor-pointer" id="newOfferItemCreateIcon"></i></h5>
            </div>
            <div class="col-xl-4 text-right">
                <i class="fa fa-trash text-danger cursor-pointer" id="newOfferItemDeleteIcon" style="display: none"></i>
            </div>
        </div>
        <div class="row mt-6">
            <input type="hidden" id="new_offer_item_id_edit">
            <div class="col-xl-12">
                <table class="table table-bordered table-hover" id="newOfferItems">
                    <thead>
                    <tr>
                        <th>stockId</th>
                        <th>unitId</th>
                        <th>Mal/Hizmet</th>
                        <th>Miktar</th>
                        <th>Birim</th>
                        <th>Birim Fiyat</th>
                        <th>İskonto Oranı</th>
                        <th>İskonto Tutarı</th>
                        <th>Mal/Hizmet Tutarı</th>
                        <th>KDV Oranı</th>
                        <th>KDV Tutarı</th>
                        <th>Genel Toplam</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-8"></div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="newOfferSubtotalInput">Mal/Hizmet Tutarı</label>
                                    <input type="text" id="newOfferSubtotalInput" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="newOfferDiscountTotalInput">İskonto Tutarı</label>
                                    <input type="text" id="newOfferDiscountTotalInput" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="newOfferVatTotalInput">KDV Tutarı</label>
                                    <input type="text" id="newOfferVatTotalInput" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="newOfferGrandTotalInput">Genel Toplam</label>
                                    <input type="text" id="newOfferGrandTotalInput" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
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
</div>
