<div id="EditRightbar" style="width: 1500px; max-width: 90%" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="edit_rightbar_toggle">
    <input type="hidden" id="id_edit">
    <div class="offcanvas-content">
        <div class="offcanvas-wrapper mb-5 scroll-pull">
            <div class="row">
                <div class="col-xl-10">
                    <h5>Teklifi Düzenle</h5>
                </div>
            </div>
            <hr>
            <div class="row mt-6 pr-7">
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
                        <label for="user_id_edit">Temsilci Seçimi</label>
                        <select id="user_id_edit" class="form-control">

                        </select>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="relation_type_edit">Bağlantı Türü</label>
                        <select id="relation_type_edit" class="form-control">
                            <option value="App\Models\Opportunity">Fırsat</option>
                            <option value="App\Models\Customer">Müşteri</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="relation_id_edit">Bağlantı</label>
                        <select id="relation_id_edit" class="form-control">

                        </select>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="subject_edit">Konu</label>
                        <input type="text" id="subject_edit" class="form-control">
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="expiry_date_edit">Geçerlilik Tarihi</label>
                        <input type="date" id="expiry_date_edit" class="form-control">
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="pay_type_id_edit">Ödeme Türü</label>
                        <select id="pay_type_id_edit" class="form-control">

                        </select>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="delivery_type_id_edit">Teslim Türü</label>
                        <select id="delivery_type_id_edit" class="form-control">

                        </select>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">
                        <label for="currency_type_edit">Döviz</label>
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
                        <label for="currency_edit">Kur</label>
                        <input type="text" id="currency_edit" class="form-control decimal">
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
                        <label for="calendar_edit">Takvimde Gösterilsin</label>
                        <select id="calendar_edit" class="form-control">
                            <option value="0">Hayır</option>
                            <option value="1">Evet</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-group">
                        <label for="description_edit">Açıklamalar</label>
                        <textarea id="description_edit" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-8">
                <h5>Malzemeler<i class="ml-2 fa fa-plus-circle text-success cursor-pointer" id="offerItemCreateIcon"></i></h5>
            </div>
            <div class="col-xl-4 text-right">
                <i class="fa fa-trash text-danger cursor-pointer" id="offerItemDeleteIcon" style="display: none"></i>
            </div>
        </div>
        <div class="row mt-6">
            <input type="hidden" id="offer_item_id_edit">
            <div class="col-xl-12">
                <table class="table table-bordered table-hover" id="offerItems">
                    <thead>
                    <tr>
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
                                    <label for="offerSubtotalInput">Mal/Hizmet Tutarı</label>
                                    <input type="text" id="offerSubtotalInput" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="offerDiscountTotalInput">İskonto Tutarı</label>
                                    <input type="text" id="offerDiscountTotalInput" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="offerVatTotalInput">KDV Tutarı</label>
                                    <input type="text" id="offerVatTotalInput" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="offerGrandTotalInput">Genel Toplam</label>
                                    <input type="text" id="offerGrandTotalInput" class="form-control" disabled>
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
                    <button type="button" class="btn btn-success" id="UpdateButton">Güncelle</button>
                </div>
            </div>
        </div>
    </div>
</div>
