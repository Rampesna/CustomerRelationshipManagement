<div class="modal fade" id="CreateOfferItemModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Kalem Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="CreateOfferItemForm">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="offer_item_stock_id_create">Mal / Hizmet</label>
                                <select id="offer_item_stock_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="offer_item_amount_create">Miktar</label>
                                <input type="text" id="offer_item_amount_create" class="form-control decimal">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="offer_item_unit_id_create">Birim</label>
                                <select id="offer_item_unit_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="offer_item_unit_price_create">Birim Fiyat</label>
                                <input type="text" id="offer_item_unit_price_create" class="form-control decimal">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="offer_item_vat_rate_create">KDV Oranı</label>
                                <input type="text" id="offer_item_vat_rate_create" class="form-control decimal">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="offer_item_vat_total_create">KDV Tutarı</label>
                                <input type="text" id="offer_item_vat_total_create" class="form-control decimal" disabled>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="offer_item_discount_rate_create">İskonto Oranı</label>
                                <input type="text" id="offer_item_discount_rate_create" class="form-control decimal">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="offer_item_discount_total_create">İskonto Oranı</label>
                                <input type="text" id="offer_item_discount_total_create" class="form-control decimal" disabled>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="offer_item_subtotal_create">Mal / Hizmet Tutarı</label>
                                <input type="text" id="offer_item_subtotal_create" class="form-control decimal" disabled>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="offer_item_grand_total_create">Genel Toplam</label>
                                <input type="text" id="offer_item_grand_total_create" class="form-control decimal" disabled>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="offer_item_description_create">Açıklamalar</label>
                                <textarea class="form-control" id="offer_item_description_create" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="CreateOfferItemButton">Ekle</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancelCreateComment">Vazgeç</button>
            </div>
        </div>
    </div>
</div>
