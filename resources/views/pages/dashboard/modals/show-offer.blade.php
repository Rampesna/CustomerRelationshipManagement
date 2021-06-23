<div class="modal fade" id="ShowOfferModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:1100px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Teklif Detayları</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0" id="show_offer_subject"></h6>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <div>Bağlantı Türü</div>
                    <div id="show_offer_relation_type"></div>
                </div>
                <br>
                <div class="d-flex justify-content-between">
                    <div>Bağlantı</div>
                    <div id="show_offer_relation"></div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <div>Teklif Geçerlilik Tarihi</div>
                    <div id="show_offer_expiry_date"></div>
                </div>
                <br>
                <div class="d-flex justify-content-between">
                    <div>Ödeme Türü</div>
                    <div id="show_offer_pay_tpe"></div>
                </div>
                <br>
                <div class="d-flex justify-content-between">
                    <div>Teslim Türü</div>
                    <div id="show_offer_delivery_type"></div>
                </div>
                <br>
                <div class="d-flex justify-content-between">
                    <div>Döviz</div>
                    <div id="show_offer_currency_type"></div>
                </div>
                <br>
                <div class="d-flex justify-content-between">
                    <div>Kur</div>
                    <div id="show_offer_currency"></div>
                </div>
                <br>
                <div class="d-flex justify-content-between">
                    <div>Durum</div>
                    <div id="show_offer_status"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <table class="table">
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
                            <tbody id="ShowOfferItems">

                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-8"></div>
                    <div class="col-xl-4">
                        <div class="row text-right">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="offerSubtotalInput" class="font-weight-bolder">Mal/Hizmet Tutarı: </label><span id="offerSubtotalInput" class="ml-2"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 mt-n7">
                                <div class="form-group">
                                    <label for="offerSubtotalInput" class="font-weight-bolder">İskonto Tutarı: </label><span id="offerDiscountTotalInput" class="ml-2"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 mt-n7">
                                <div class="form-group">
                                    <label for="offerSubtotalInput" class="font-weight-bolder">KDV Tutarı: </label><span id="offerVatTotalInput" class="ml-2"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 mt-n7">
                                <div class="form-group">
                                    <label for="offerSubtotalInput" class="font-weight-bolder">Genel Toplam: </label><span id="offerGrandTotalInput" class="ml-2"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
