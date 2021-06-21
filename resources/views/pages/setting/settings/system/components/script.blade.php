<script>

    var SelectedCompany = $("#SelectedCompany");

    var UpdateButton = $("#UpdateButton");

    var sendOpportunityEmail = $("#send_opportunity_email");
    var sendActivityEmail = $("#send_activity_email");
    var sendCustomerEmail = $("#send_customer_email");
    var sendManagerEmail = $("#send_manager_email");
    var sendSampleEmail = $("#send_sample_email");
    var sendOfferEmail = $("#send_offer_email");
    var sendStockEmail = $("#send_stock_email");
    var sendPricelistEmail = $("#send_pricelist_email");

    function getSettings() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.setting.show') }}',
            data: {
                company_id: SelectedCompany.val()
            },
            success: function (settings) {
                sendOpportunityEmail.prop('checked', settings.send_opportunity_email === 1);
                sendActivityEmail.prop('checked', settings.send_activity_email === 1);
                sendCustomerEmail.prop('checked', settings.send_customer_email === 1);
                sendManagerEmail.prop('checked', settings.send_manager_email === 1);
                sendSampleEmail.prop('checked', settings.send_sample_email === 1);
                sendOfferEmail.prop('checked', settings.send_offer_email === 1);
                sendStockEmail.prop('checked', settings.send_stock_email === 1);
                sendPricelistEmail.prop('checked', settings.send_pricelist_email === 1);
            },
            error: function (error) {
                toastr.error('Sistem Ayarları Alınırken Bir Hata Oluştu!');
                console.log(error);
            }
        });
    }

    getSettings();

    UpdateButton.click(function () {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.setting.updateSystemSettings') }}',
            data: {
                _token: '{{ csrf_token() }}',
                company_id: SelectedCompany.val(),
                send_opportunity_email: sendOpportunityEmail.is(':checked') ? 1 : 0,
                send_activity_email: sendActivityEmail.is(':checked') ? 1 : 0,
                send_customer_email: sendCustomerEmail.is(':checked') ? 1 : 0,
                send_manager_email: sendManagerEmail.is(':checked') ? 1 : 0,
                send_sample_email: sendSampleEmail.is(':checked') ? 1 : 0,
                send_offer_email: sendOfferEmail.is(':checked') ? 1 : 0,
                send_stock_email: sendStockEmail.is(':checked') ? 1 : 0,
                send_pricelist_email: sendPricelistEmail.is(':checked') ? 1 : 0,
            },
            success: function () {
                toastr.success('Bilgiler Güncellendi!');
            },
            error: function (error) {
                toastr.error('Bilgiler Güncellenirken Sistemsel Bir Hata Oluştu!');
                console.log(error);
            }
        });
    });

    SelectedCompany.change(function () {
        getSettings();
    });
</script>
