<?php

namespace App\Services;

use App\Events\SendEmailEvent;
use App\Models\Company;
use App\Models\Country;
use App\Models\Definition;
use App\Models\District;
use App\Models\Opportunity;
use App\Models\OpportunityActivity;
use App\Models\Province;
use App\Models\Setting;
use App\Models\User;
use Cyberduck\LaravelExcel\Importer\Excel;
use Illuminate\Http\Request;

class OpportunityService
{
    private $opportunity;

    /**
     * @return Opportunity
     */
    public function getOpportunity(): Opportunity
    {
        return $this->opportunity;
    }

    /**
     * @param Opportunity $opportunity
     */
    public function setOpportunity(Opportunity $opportunity): void
    {
        $this->opportunity = $opportunity;
    }

    public function save(Request $request)
    {
        $this->opportunity->user_id = $request->user_id;
        $this->opportunity->company_id = $request->company_id;
        $this->opportunity->customer_id = $request->customer_id;
        $this->opportunity->name = $request->name;
        $this->opportunity->email = $request->email;
        $this->opportunity->identification_number = $request->identification_number;
        $this->opportunity->phone_number = $request->phone_number;
        $this->opportunity->manager_name = $request->manager_name;
        $this->opportunity->manager_email = $request->manager_email;
        $this->opportunity->manager_phone_number = $request->manager_phone_number;
        $this->opportunity->website = $request->website;
        $this->opportunity->description = $request->description;
        $this->opportunity->date = $request->date;
        $this->opportunity->price = $request->price;
        $this->opportunity->currency = $request->currency;
        $this->opportunity->priority_id = $request->priority_id;
        $this->opportunity->access_type_id = $request->access_type_id;
        $this->opportunity->domestic = $request->domestic;
        $this->opportunity->country_id = $request->country_id;
        $this->opportunity->province_id = $request->province_id;
        $this->opportunity->district_id = $request->district_id;
        $this->opportunity->foundation_date = $request->foundation_date;
        $this->opportunity->estimated_result = $request->estimated_result;
        $this->opportunity->estimated_result_type_id = $request->estimated_result_type_id;
        $this->opportunity->capacity = $request->capacity;
        $this->opportunity->capacity_type_id = $request->capacity_type_id;
        $this->opportunity->status_id = $request->status_id;
        $this->opportunity->calendar = $request->calendar;
        $this->opportunity->created_by = $request->id ? $this->opportunity->created_by : $request->auth_user_id;
        $this->opportunity->last_updated_by = $request->auth_user_id;
        $this->opportunity->save();

        $this->opportunity->brands()->syncWithPivotValues($request->brands, ['relation_type' => 'App\\Models\\Opportunity']);
        $this->opportunity->sectors()->syncWithPivotValues($request->sectors, ['relation_type' => 'App\\Models\\Opportunity']);

        $opportunityActivityService = new OpportunityActivityService;
        $opportunityActivityService->setOpportunityActivity(new OpportunityActivity);
        $opportunityActivityService->save($request->auth_user_id, $this->opportunity->id, $request->status_id);

        if (!$request->id) {
            event(new SendEmailEvent([
                'setting' => Setting::where('company_id', $this->opportunity->company_id)->first(),
                'opportunity' => $this->opportunity
            ]));
        }

        return $this->opportunity;
    }

    public function saveWithParams(
        $id,
        $userId,
        $companyId,
        $customerId,
        $name,
        $email,
        $identificationNumber,
        $phoneNumber,
        $managerName,
        $managerEmail,
        $managerPhoneNumber,
        $website,
        $description,
        $date,
        $price,
        $currency,
        $priorityId,
        $accessTypeId,
        $domestic,
        $countryId,
        $provinceId,
        $districtId,
        $foundationDate,
        $estimatedResult,
        $estimatedResultTypeId,
        $capacity,
        $capacityTypeId,
        $statusId,
        $calendar,
        $createdBy,
        $lastUpdatedBy,
        $brands,
        $sectors
    )
    {
        $opportunity = $id ? Opportunity::find($id) : new Opportunity;
        $opportunity->user_id = $userId;
        $opportunity->company_id = $companyId;
        $opportunity->customer_id = $customerId;
        $opportunity->name = $name;
        $opportunity->email = $email;
        $opportunity->identification_number = $identificationNumber;
        $opportunity->phone_number = $phoneNumber;
        $opportunity->manager_name = $managerName;
        $opportunity->manager_email = $managerEmail;
        $opportunity->manager_phone_number = $managerPhoneNumber;
        $opportunity->website = $website;
        $opportunity->description = $description;
        $opportunity->date = $date;
        $opportunity->price = $price;
        $opportunity->currency = $currency;
        $opportunity->priority_id = $priorityId;
        $opportunity->access_type_id = $accessTypeId;
        $opportunity->domestic = $domestic;
        $opportunity->country_id = $countryId;
        $opportunity->province_id = $provinceId;
        $opportunity->district_id = $districtId;
        $opportunity->foundation_date = $foundationDate;
        $opportunity->estimated_result = $estimatedResult;
        $opportunity->estimated_result_type_id = $estimatedResultTypeId;
        $opportunity->capacity = $capacity;
        $opportunity->capacity_type_id = $capacityTypeId;
        $opportunity->status_id = $statusId;
        $opportunity->calendar = $calendar;
        $opportunity->created_by = $createdBy;
        $opportunity->last_updated_by = $lastUpdatedBy;
        $opportunity->save();

        $opportunity->brands()->syncWithPivotValues($brands, ['relation_type' => 'App\\Models\\Opportunity']);
        $opportunity->sectors()->syncWithPivotValues($sectors, ['relation_type' => 'App\\Models\\Opportunity']);

        return $opportunity;
    }

    public function import(Request $request)
    {
        if (!$request->hasFile('excel')) {
            return [
                'type' => 'warning',
                'message' => 'Dosya Seçmediniz!'
            ];
        }

        if ($request->file('excel')->getMimeType() != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            return [
                'type' => 'warning',
                'message' => 'Sadece .xlsx uzantılı dosyalar içeri aktarılabilir!'
            ];
        }

        $fileName = date('Ymd_His_') . '-' . $request->file('excel')->getClientOriginalName();
        $path = public_path('/opportunities/excels/');
        $request->file('excel')->move($path, $fileName);

        $excel = new Excel();
        $excel->load($path . $fileName);
        $collection = $excel->getCollection();

        $opportunities = [];
        $iteration = 0;

        foreach ($collection as $data) {
            if ($iteration == 0) {
                $iteration = 1;
            } else {
                $user = User::where('name', $data[0])->first();
                $company = Company::where('name', $data[1])->first();
                if ($company) {
                    $opportunities[] = [
                        'user_id' => $user->id ?? null,
                        'company_id' => $company->id,
                        'name' => $data[2] ?? null,
                        'email' => $data[3] ?? null,
                        'phone_number' => $data[4] ?? null,
                        'manager_name' => $data[5] ?? null,
                        'manager_email' => $data[6] ?? null,
                        'manager_phone_number' => $data[7] ?? null,
                        'website' => $data[8] ?? null,
                        'description' => $data[9] ?? null,
                        'date' => $data[10] && $data[10] instanceof \DateTime ? date_format($data[10], 'Y-m-d') : date('Y-m-d', strtotime($data[10])),
                        'price' => $data[11] != '' ? $data[11] : null,
                        'currency' => $data[12] ?? null,
                        'priority_id' => Definition::where('company_id', $company->id)->where('name', 'Fırsat Öncelik Durumları')->first()->definitions()->where('name', $data[13])->first()->id ?? null,
                        'access_type_id' => Definition::where('company_id', $company->id)->where('name', 'Fırsat Erişim Türleri')->first()->definitions()->where('name', $data[14])->first()->id ?? null,
                        'domestic' => $data[15] == 'Yerli' || $data[15] == 'Yerlı' || $data[15] == 'YERLİ' || $data[15] == 'YERLI' ? 0 : 1,
                        'country_id' => Country::where('name', $data[16])->first()->id ?? null,
                        'province_id' => Province::where('name', $data[17])->first()->id ?? null,
                        'district_id' => District::where('name', $data[18])->first()->id ?? null,
                        'foundation_date' => $data[19] && $data[19] instanceof \DateTime ? date_format($data[19], 'Y-m-d') : date('Y-m-d', strtotime($data[19])),
                        'estimated_result' => $data[20] != '' ? intval($data[20]) : null,
                        'estimated_result_type_id' => Definition::where('company_id', $company->id)->where('name', 'Fırsat Tahmini Sonuçlanma Türleri')->first()->definitions()->where('name', $data[21])->first()->id ?? null,
                        'capacity' => $data[11] != '' ? floatval($data[22]) : null,
                        'capacity_type_id' => Definition::where('company_id', $company->id)->where('name', 'Fırsat Kapasite Türleri')->first()->definitions()->where('name', $data[23])->first()->id ?? null,
                        'status_id' => Definition::where('company_id', $company->id)->where('name', 'Fırsat Durumları')->first()->definitions()->where('name', $data[24])->first()->id ?? null,
                    ];
                } else {
                    return [
                        'type' => 'warning',
                        'message' => 'Dosyada Sistemde Kayıtlı Olmayan Firma İsmi Mevcut!'
                    ];
                }
            }
        }

        foreach ($opportunities as $opportunity) {
            $this->opportunity = new Opportunity;
            $this->opportunity->user_id = $opportunity['user_id'];
            $this->opportunity->company_id = $opportunity['company_id'];
            $this->opportunity->customer_id = null;
            $this->opportunity->name = $opportunity['name'];
            $this->opportunity->email = $opportunity['email'];
            $this->opportunity->phone_number = $opportunity['phone_number'];
            $this->opportunity->manager_name = $opportunity['manager_name'];
            $this->opportunity->manager_email = $opportunity['manager_email'];
            $this->opportunity->manager_phone_number = $opportunity['manager_phone_number'];
            $this->opportunity->website = $opportunity['website'];
            $this->opportunity->description = $opportunity['description'];
            $this->opportunity->date = $opportunity['date'];
            $this->opportunity->price = $opportunity['price'];
            $this->opportunity->currency = $opportunity['currency'];
            $this->opportunity->priority_id = $opportunity['priority_id'];
            $this->opportunity->access_type_id = $opportunity['access_type_id'];
            $this->opportunity->domestic = $opportunity['domestic'];
            $this->opportunity->country_id = $opportunity['country_id'];
            $this->opportunity->province_id = $opportunity['province_id'];
            $this->opportunity->district_id = $opportunity['district_id'];
            $this->opportunity->foundation_date = $opportunity['foundation_date'];
            $this->opportunity->estimated_result = $opportunity['estimated_result'];
            $this->opportunity->estimated_result_type_id = $opportunity['estimated_result_type_id'];
            $this->opportunity->capacity = $opportunity['capacity'];
            $this->opportunity->capacity_type_id = $opportunity['capacity_type_id'];
            $this->opportunity->status_id = $opportunity['status_id'];
            $this->opportunity->calendar = 0;
            $this->opportunity->created_by = $request->auth_user_id;
            $this->opportunity->last_updated_by = $request->auth_user_id;
            $this->opportunity->save();
        }

        return [
            'type' => 'success',
            'message' => 'Fırsatlar Başarıyla İçe Aktarıldı'
        ];
    }
}
