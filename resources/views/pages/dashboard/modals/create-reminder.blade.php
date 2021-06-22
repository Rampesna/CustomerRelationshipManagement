<div class="modal fade" id="CreateReminderModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Hatırlatıcı Oluştur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="create_reminder_form" class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="create_reminder_date">Hatırlatıcı Zamanı</label>
                            <input type="datetime-local" id="create_reminder_date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="create_reminder_title">Hatırlatıcı Başlığı</label>
                            <input type="text" id="create_reminder_title" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="create_reminder_note">Hatırlatıcı İçeriği</label>
                            <textarea id="create_reminder_note" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label>Hatırlatma Seçenekleri: </label>
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-success">
                                    <input id="create_reminder_notification" type="checkbox" checked>Sistem Bildirimi
                                    <span></span>
                                </label>
                                <label class="checkbox checkbox-success ml-3">
                                    <input id="create_reminder_mail" type="checkbox" checked>Mail
                                    <span></span>
                                </label>
                                <label class="checkbox checkbox-success ml-3">
                                    <input id="create_reminder_sms" type="checkbox" disabled>SMS (Aktif Değil)
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="createReminderButton">Oluştur</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancelCreateReminderButton">Vazgeç</button>
            </div>
        </div>
    </div>
</div>
