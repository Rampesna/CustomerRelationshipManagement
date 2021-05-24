<div id="EditRightbar" style="width: 1500px" class="offcanvas offcanvas-right p-10">
    <input type="hidden" id="edit_rightbar_toggle">
    <input type="hidden" id="id_edit">
    <div class="offcanvas-content">
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
</div>
