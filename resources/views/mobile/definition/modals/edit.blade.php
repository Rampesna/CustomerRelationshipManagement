<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_edit">
                <div class="row">
                    <div class="col-xl-12">
                        <h5>Tanımlamalar</h5>
                    </div>
                    @Authority(61)
                    <div class="col-xl-4 text-right">
                        <div class="input-group">
                            <label for="sub_definition_name_create"></label>
                            <input type="text" class="form-control" id="sub_definition_name_create" placeholder="Yeni Tanımlama Oluştur">
                            <div class="input-group-append">
                                <button class="btn btn-success" id="subDefinitionCreateButton" type="button">+</button>
                            </div>
                        </div>
                    </div>
                    @endAuthority

                    @Authority(63)
                    <div class="col-xl-8 text-right">
                        <i class="fa fa-trash text-danger cursor-pointer" id="subDefinitionDeleteIcon" style="display: none"></i>
                    </div>
                    @endAuthority
                </div>
                <div class="row mt-6">
                    <input type="hidden" id="sub_definition_id_edit">
                    <div class="col-xl-12">
                        <table class="table table-bordered table-hover" id="subDefinitions">
                            <thead>
                            <tr>
                                <th>Tanımlama</th>
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
        </div>
    </div>
</div>
