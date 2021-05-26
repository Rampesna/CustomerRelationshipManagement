<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    var SelectedCompany = $("#SelectedCompany");

    var companyIdEdit = $("#company_id_edit");
    var userIdEdit = $("#user_id_edit");
    var customerIdEdit = $("#customer_id_edit");
    var countryIdEdit = $("#country_id_edit");
    var provinceIdEdit = $("#province_id_edit");
    var districtIdEdit = $("#district_id_edit");
    var priorityIdEdit = $("#priority_id_edit");
    var accessTypeIdEdit = $("#access_type_id_edit");
    var estimatedResultTypeIdEdit = $("#estimated_result_type_id_edit");
    var capacityTypeIdEdit = $("#capacity_type_id_edit");
    var statusIdEdit = $("#status_id_edit");

    var UpdateButton = $("#UpdateButton");

    function edit() {
        $("#edit_rightbar_toggle").trigger('click');

        var id = $("#id_edit").val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.opportunity.show') }}',
            data: {
                id: id
            },
            success: function (opportunity) {
                $("#company_id_edit").val(opportunity.company_id).selectpicker('refresh');
                $("#user_id_edit").val(opportunity.user_id).selectpicker('refresh');
                $("#customer_id_edit").val(opportunity.customer_id).selectpicker('refresh');
                $("#name_edit").val(opportunity.name);
                $("#email_edit").val(opportunity.email);
                $("#domestic_edit").val(opportunity.domestic).selectpicker('refresh');
                $("#country_id_edit").val(opportunity.country_id).selectpicker('refresh');
                $("#phone_number_edit").val(opportunity.phone_number);
                $("#province_id_edit").val(opportunity.province_id).selectpicker('refresh');
                $("#district_id_edit").val(opportunity.district_id).selectpicker('refresh');
                $("#website_edit").val(opportunity.website);
                $("#foundation_date_edit").val(opportunity.foundation_date);
                $("#manager_name_edit").val(opportunity.manager_name);
                $("#manager_email_edit").val(opportunity.manager_email);
                $("#manager_phone_number_edit").val(opportunity.manager_phone_number);
                $("#date_edit").val(opportunity.date);
                $("#price_edit").val(opportunity.price);
                $("#currency_edit").val(opportunity.currency).selectpicker('refresh');
                $("#priority_id_edit").val(opportunity.priority_id).selectpicker('refresh');
                $("#access_type_id_edit").val(opportunity.access_type_id).selectpicker('refresh');
                $("#estimated_result_edit").val(opportunity.estimated_result);
                $("#estimated_result_type_id_edit").val(opportunity.estimated_result_type_id).selectpicker('refresh');
                $("#capacity_edit").val(opportunity.capacity);
                $("#capacity_type_id_edit").val(opportunity.capacity_type_id).selectpicker('refresh');
                $("#status_id_edit").val(opportunity.status_id).selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getCountries() {
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('ajax.country.index') }}',
            data: {},
            success: function (countries) {
                countryIdEdit.empty();
                $.each(countries, function (index) {
                    countryIdEdit.append(`<option ${countries[index].short === 'TR' && countries[index].code === '90' ? 'selected' : null} value="${countries[index].id}">${countries[index].name} (+${countries[index].code})</option>`);
                });
                countryIdEdit.selectpicker('refresh');
                getProvincesEdit();
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getProvincesEdit() {
        var country_id = countryIdEdit.val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.province.index') }}',
            data: {
                country_id: country_id
            },
            success: function (provinces) {
                provinceIdEdit.empty();
                $.each(provinces, function (index) {
                    provinceIdEdit.append(`<option value="${provinces[index].id}">${provinces[index].name}</option>`);
                });
                provinceIdEdit.selectpicker('refresh');
                getDistrictsEdit();
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getDistrictsEdit() {
        var province_id = provinceIdEdit.val();

        $.ajax({
            type: 'get',
            url: '{{ route('ajax.district.index') }}',
            data: {
                province_id: province_id
            },
            success: function (districts) {
                districtIdEdit.empty();
                $.each(districts, function (index) {
                    districtIdEdit.append(`<option value="${districts[index].id}">${districts[index].name}</option>`);
                });
                districtIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getUsers(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.user.index') }}',
            data: {
                company_id: company_id
            },
            success: function (users) {
                userIdEdit.empty();
                userIdEdit.append(`<optgroup label=""><option value="" selected>Seçim Yok</optgroup>`);
                $.each(users, function (index) {
                    userIdEdit.append(`<option value="${users[index].id}">${users[index].name}</option>`);
                });
                userIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getCustomers(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.customer.index') }}',
            data: {
                company_id: company_id
            },
            success: function (customers) {
                customerIdEdit.empty();
                customerIdEdit.append(`<optgroup label=""><option value="" selected>Seçim Yok</optgroup>`);
                $.each(customers, function (index) {
                    customerIdEdit.append(`<option value="${customers[index].id}">${customers[index].title}</option>`);
                });
                customerIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getOpportunityPriorities(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.opportunityPriorities') }}',
            data: {
                company_id: company_id
            },
            success: function (priorities) {
                priorityIdEdit.empty();
                $.each(priorities, function (index) {
                    priorityIdEdit.append(`<option value="${priorities[index].id}">${priorities[index].name}</option>`);
                });
                priorityIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getOpportunityAccessTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.opportunityAccessTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (accessTypes) {
                accessTypeIdEdit.empty();
                $.each(accessTypes, function (index) {
                    accessTypeIdEdit.append(`<option value="${accessTypes[index].id}">${accessTypes[index].name}</option>`);
                });
                accessTypeIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getOpportunityEstimatedResultTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.opportunityEstimatedResultTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (estimatedResultTypes) {
                estimatedResultTypeIdEdit.empty();
                $.each(estimatedResultTypes, function (index) {
                    estimatedResultTypeIdEdit.append(`<option value="${estimatedResultTypes[index].id}">${estimatedResultTypes[index].name}</option>`);
                });
                estimatedResultTypeIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getOpportunityCapacityTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.opportunityCapacityTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (capacityTypes) {
                capacityTypeIdEdit.empty();
                $.each(capacityTypes, function (index) {
                    capacityTypeIdEdit.append(`<option value="${capacityTypes[index].id}">${capacityTypes[index].name}</option>`);
                });
                capacityTypeIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getOpportunityStatuses(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.opportunityStatuses') }}',
            data: {
                company_id: company_id
            },
            success: function (statuses) {
                statusIdEdit.empty();
                $.each(statuses, function (index) {
                    statusIdEdit.append(`<option value="${statuses[index].id}">${statuses[index].name}</option>`);
                });
                statusIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    countryIdEdit.change(function () {
        getProvincesEdit();
    });

    provinceIdEdit.change(function () {
        getDistrictsEdit();
    });

    getCountries();
    getUsers({{ $opportunity->company_id }});
    getCustomers({{ $opportunity->company_id }});
    getOpportunityPriorities({{ $opportunity->company_id }});
    getOpportunityAccessTypes({{ $opportunity->company_id }});
    getOpportunityEstimatedResultTypes({{ $opportunity->company_id }});
    getOpportunityCapacityTypes({{ $opportunity->company_id }});
    getOpportunityStatuses({{ $opportunity->company_id }});

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var user_id = $("#user_id_edit").val();
        var company_id = $("#company_id_edit").val();
        var customer_id = $("#customer_id_edit").val();
        var name = $("#name_edit").val();
        var email = $("#email_edit").val();
        var phone_number = $("#phone_number_edit").val();
        var manager_name = $("#manager_name_edit").val();
        var manager_email = $("#manager_email_edit").val();
        var manager_phone_number = $("#manager_phone_number_edit").val();
        var website = $("#website_edit").val();
        var description = $("#description_edit").val();
        var date = $("#date_edit").val();
        var price = $("#price_edit").val();
        var currency = $("#currency_edit").val();
        var priority_id = $("#priority_id_edit").val();
        var access_type_id = $("#access_type_id_edit").val();
        var domestic = $("#domestic_edit").val();
        var country_id = $("#country_id_edit").val();
        var province_id = $("#province_id_edit").val();
        var district_id = $("#district_id_edit").val();
        var foundation_date = $("#foundation_date_edit").val();
        var estimated_result = $("#estimated_result_edit").val();
        var estimated_result_type_id = $("#estimated_result_type_id_edit").val();
        var capacity = $("#capacity_edit").val();
        var capacity_type_id = $("#capacity_type_id_edit").val();
        var status_id = $("#status_id_edit").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else {

            $("#EditModal").modal('hide');
            $("#loader").fadeIn(250);

            saveOpportunity({
                _token: '{{ csrf_token() }}',
                auth_user_id: auth_user_id,
                id: id,
                user_id: user_id,
                company_id: company_id,
                customer_id: customer_id,
                name: name,
                email: email,
                phone_number: phone_number,
                manager_name: manager_name,
                manager_email: manager_email,
                manager_phone_number: manager_phone_number,
                website: website,
                description: description,
                date: date,
                price: price,
                currency: currency,
                priority_id: priority_id,
                access_type_id: access_type_id,
                domestic: domestic,
                country_id: country_id,
                province_id: province_id,
                district_id: district_id,
                foundation_date: foundation_date,
                estimated_result: estimated_result,
                estimated_result_type_id: estimated_result_type_id,
                capacity: capacity,
                capacity_type_id: capacity_type_id,
                status_id: status_id,
            }, 'Fırsat Başarıyla Güncellendi', 'Fırsat Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    function saveOpportunity(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.opportunity.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                location.reload();
            },
            error: function (error) {
                toastr.error(errorMessage);
                console.log(error)
                $("#loader").fadeOut(250);
            }
        });
    }
</script>
