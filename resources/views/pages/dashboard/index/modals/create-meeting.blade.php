<div class="modal fade" id="CreateMeetingModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div id="create_device_form" class="modal-dialog" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Toplantı Oluştur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="CreateMeetingForm" class="modal-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="create_meeting_company_id">Firma Seçimi</label>
                            <select id="create_meeting_company_id" class="form-control selectpicker">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group"><label for="create_meeting_title">Toplantı Başlığı</label>
                            <input type="text" id="create_meeting_title" class="form-control"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="create_meeting_description">Toplantı İçeriği</label>
                            <textarea id="create_meeting_description" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="create_meeting_start_date">Başlangıç Tarihi</label>
                            <input type="datetime-local" class="form-control" id="create_meeting_start_date">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="create_meeting_end_date">Bitiş Tarihi</label>
                            <input type="datetime-local" class="form-control" id="create_meeting_end_date">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="create_meeting_type">Görüşme Türü</label>
                            <select id="create_meeting_type" class="form-control">
                                <option value="0">Yüzyüze</option>
                                <option value="1">Online</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="create_meeting_address">Toplantı Adresi</label>
                            <input type="text" id="create_meeting_address" class="form-control">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="create_meeting_users">Katılımcılar</label>
                            <select id="create_meeting_users" class="form-control" multiple>

                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="CreateMeetingButton">Oluştur</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Vazgeç</button>
            </div>
        </div>
    </div>
</div>
