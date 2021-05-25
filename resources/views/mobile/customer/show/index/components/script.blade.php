<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>
    const months = [
        'Ocak',
        'Şubat',
        'Mart',
        'Nisan',
        'Mayıs',
        'Haziran',
        'Temmuz',
        'Ağustos',
        'Eylül',
        'Ekim',
        'Kasım',
        'Aralık',
    ];

    var editCustomer = $("#editCustomer");
    var SelectedCompany = $("#SelectedCompany");

    var companyIdEdit = $("#company_id_edit");
    var countryIdEdit = $("#country_id_edit");
    var provinceIdEdit = $("#province_id_edit");
    var districtIdEdit = $("#district_id_edit");
    var classIdEdit = $("#class_id_edit");
    var typeIdEdit = $("#type_id_edit");
    var referenceIdEdit = $("#reference_id_edit");

    var UpdateButton = $("#UpdateButton");

    editCustomer.click(function () {
        $("#EditForm").hide();
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.customer.show') }}',
            data: {
                id: '{{ $customer->id }}'
            },
            success: function (customer) {
                $("#company_id_edit").val(customer.company_id).selectpicker('refresh');
                $("#title_edit").val(customer.title);
                $("#tax_number_edit").val(customer.tax_number);
                $("#tax_office").val(customer.tax_office);
                $("#email_edit").val(customer.email);
                $("#country_id_edit").val(customer.country_id).selectpicker('refresh');
                $("#phone_number_edit").val(customer.phone_number);
                getProvincesEdit();
                $("#province_id_edit").val(customer.province_id).selectpicker('refresh');
                getDistrictsEdit();
                $("#district_id_edit").val(customer.district_id).selectpicker('refresh');
                $("#website_edit").val(customer.website);
                $("#foundation_date_edit").val(customer.foundation_date);
                $("#class_id_edit").val(customer.class_id).selectpicker('refresh');
                $("#type_id_edit").val(customer.type_id).selectpicker('refresh');
                $("#reference_id_edit").val(customer.reference_id).selectpicker('refresh');
                $("#EditForm").fadeIn(250);
            },
            error: function (error) {
                console.log(error)
                $("#EditModal").fadeIn(250);
            }
        });
    });

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
            async: false,
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
            async: false,
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

    function getCustomerClasses(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.customerClasses') }}',
            data: {
                company_id: company_id
            },
            success: function (classes) {
                classIdEdit.empty();
                $.each(classes, function (index) {
                    classIdEdit.append(`<option value="${classes[index].id}">${classes[index].name}</option>`);
                });
                classIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getCustomerTypes(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.customerTypes') }}',
            data: {
                company_id: company_id
            },
            success: function (types) {
                typeIdEdit.empty();
                $.each(types, function (index) {
                    typeIdEdit.append(`<option value="${types[index].id}">${types[index].name}</option>`);
                });
                typeIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getCustomerReferences(company_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.customerReferences') }}',
            data: {
                company_id: company_id
            },
            success: function (references) {
                referenceIdEdit.empty();
                $.each(references, function (index) {
                    referenceIdEdit.append(`<option value="${references[index].id}">${references[index].name}</option>`);
                });
                referenceIdEdit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getCountries();
    getCustomerClasses({{ $customer->company_id }});
    getCustomerTypes({{ $customer->company_id }});
    getCustomerReferences({{ $customer->company_id }});

    countryIdEdit.change(function () {
        getProvincesEdit();
    });

    provinceIdEdit.change(function () {
        getDistrictsEdit();
    });

    UpdateButton.click(function () {
        var auth_user_id = '{{ auth()->user()->id() }}';
        var id = $("#id_edit").val();
        var company_id = $("#company_id_edit").val();
        var title = $("#title_edit").val();
        var tax_number = $("#tax_number_edit").val();
        var tax_office = $("#tax_office_edit").val();
        var email = $("#email_edit").val();
        var country_id = $("#country_id_edit").val();
        var phone_number = $("#phone_number_edit").val();
        var province_id = $("#province_id_edit").val();
        var district_id = $("#district_id_edit").val();
        var website = $("#website_edit").val();
        var foundation_date = $("#foundation_date_edit").val();
        var class_id = $("#class_id_edit").val();
        var type_id = $("#type_id_edit").val();
        var reference_id = $("#reference_id_edit").val();

        if (company_id == null || company_id === '') {
            toastr.warning('Firma Seçimi Yapılması Zorunludur!');
        } else {
            $("#EditModal").modal('hide');
            $("#loader").fadeIn(250);

            saveCustomer({
                _token: '{{ csrf_token() }}',
                id: id,
                auth_user_id: auth_user_id,
                company_id: company_id,
                title: title,
                tax_number: tax_number,
                tax_office: tax_office,
                email: email,
                country_id: country_id,
                phone_number: phone_number,
                province_id: province_id,
                district_id: district_id,
                website: website,
                foundation_date: foundation_date,
                class_id: class_id,
                type_id: type_id,
                reference_id: reference_id,
            }, 'Müşteri Başarıyla Güncellendi', 'Müşteri Güncellenirken Bir Hata Oluştu!', 1);
        }
    });

    function saveCustomer(data, successMessage, errorMessage, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.customer.save') }}',
            data: data,
            success: function (response) {
                toastr.success(successMessage);
                location.reload();
            },
            error: function (error) {
                toastr.success(errorMessage);
                $("#loader").fadeOut(250);
                console.log(error)
            }
        });
    }
</script>
