<div class="modal fade" id="CreateSampleItemModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Kalem Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="CreateSampleItemForm">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="sample_item_stock_id_create">Mal / Hizmet</label>
                                <select id="sample_item_stock_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="sample_item_amount_create">Miktar</label>
                                <input type="text" id="sample_item_amount_create" class="form-control decimal">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="sample_item_unit_id_create">Birim</label>
                                <select id="sample_item_unit_id_create" class="form-control">

                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="CreateSampleItemButton">Ekle</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Vazgeç</button>
            </div>
        </div>
    </div>
</div>
