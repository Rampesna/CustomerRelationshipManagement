<div class="modal fade" id="EditPriceListItemModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditPriceListItemForm">
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="price_list_item_stock_id_edit">Mal / Hizmet</label>
                                <select id="price_list_item_stock_id_edit" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="price_list_item_unit_price_edit">Birim Fiyat</label>
                                <input type="text" id="price_list_item_unit_price_edit" class="form-control decimal">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="price_list_item_vat_rate_edit">KDV Oranı</label>
                                <input type="text" id="price_list_item_vat_rate_edit" class="form-control decimal">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="price_list_item_currency_type_edit">Döviz Türü</label>
                                <select id="price_list_item_currency_type_edit" class="form-control">
                                    <option value="TRY" selected>TRY</option>
                                    <option value="USD">Dolar</option>
                                    <option value="EUR">Euro</option>
                                    <option value="GBP">Sterlin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="UpdatePriceListItemButton">Güncelle</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Vazgeç</button>
            </div>
        </div>
    </div>
</div>
