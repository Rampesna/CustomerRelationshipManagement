<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerService
{
    private $customer;

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }


    public function save(Request $request)
    {
        $this->customer->user_id = $request->user_id;
        $this->customer->company_id = $request->company_id;
        $this->customer->title = $request->title;
        $this->customer->tax_number = $request->tax_number;
        $this->customer->tax_office = $request->tax_office;
        $this->customer->email = $request->email;
        $this->customer->phone_number = $request->phone_number;
        $this->customer->website = $request->website;
        $this->customer->country_id = $request->country_id;
        $this->customer->province_id = $request->province_id;
        $this->customer->district_id = $request->district_id;
        $this->customer->foundation_date = $request->foundation_date;
        $this->customer->class_id = $request->class_id;
        $this->customer->type_id = $request->type_id;
        $this->customer->reference_id = $request->reference_id;
        $this->customer->created_by = $request->id ? $this->customer->created_by : $request->auth_user_id;
        $this->customer->last_updated_by = $request->auth_user_id;
        $this->customer->save();

        $this->customer->brands()->syncWithPivotValues($request->brands, ['relation_type' => 'App\\Models\\Customer']);
        $this->customer->sectors()->syncWithPivotValues($request->sectors, ['relation_type' => 'App\\Models\\Customer']);

        return $this->customer;
    }

    public function saveWithData(
        $company_id,
        $name,
        $email,
        $identificationNumber,
        $phoneNumber,
        $countryId,
        $provinceId,
        $districtId,
        $foundationDate,
        $website,
        $authUserId,
        $brands,
        $sectors
    )
    {
        $this->customer->company_id = $company_id;
        $this->customer->title = $name;
        $this->customer->email = $email;
        $this->customer->tax_number = $identificationNumber;
        $this->customer->phone_number = $phoneNumber;
        $this->customer->website = $website;
        $this->customer->country_id = $countryId;
        $this->customer->province_id = $provinceId;
        $this->customer->district_id = $districtId;
        $this->customer->foundation_date = $foundationDate;
        $this->customer->created_by = $this->customer->id ? $this->customer->created_by : $authUserId;
        $this->customer->last_updated_by = $authUserId;
        $this->customer->save();

        $this->customer->brands()->syncWithPivotValues($brands, ['relation_type' => 'App\\Models\\Customer']);
        $this->customer->sectors()->syncWithPivotValues($sectors, ['relation_type' => 'App\\Models\\Customer']);

        return $this->customer;
    }

    public function getByCompanyId(
        $company_id
    )
    {
        return Customer::where('company_id', $company_id)->get()->map(function ($customer) {
            return [
                'id' => $customer->id,
                'title' => $customer->title,
                'tax_number' => $customer->tax_number,
                'tax_office' => $customer->tax_office,
                'email' => $customer->email,
                'phone_number' => $customer->phone_number,
                'website' => $customer->website,
                'country_id' => $customer->country_id,
                'province_id' => $customer->province_id,
                'district_id' => $customer->district_id,
                'foundation_date' => $customer->foundation_date,
                'class_id' => $customer->class_id,
                'type_id' => $customer->type_id,
                'reference_id' => $customer->reference_id,
                'created_at' => $customer->created_at,
                'updated_at' => $customer->updated_at,
                'created_by' => $customer->created_by,
                'updated_by' => $customer->updated_by,
                'brands' => $customer->brands()->get()->map(function ($brand) {
                    return [
                        'id' => $brand->id,
                        'name' => $brand->name,
                    ];
                }),
                'sectors' => $customer->sectors()->get()->map(function ($sector) {
                    return [
                        'id' => $sector->id,
                        'name' => $sector->name,
                    ];
                }),
            ];
        });
    }
}
