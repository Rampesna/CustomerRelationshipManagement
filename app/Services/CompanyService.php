<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyService
{
    private $company;

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }

    public function save(Request $request)
    {
        $this->company->name = $request->name;
        $this->company->save();

        return $this->company;
    }

    public function getAll()
    {
        return Company::all()->map(function ($company) {
            return [
                'id' => $company->id,
                'name' => $company->name,
                'tax_number' => $company->tax_number,
                'tax_office' => $company->tax_office,
            ];
        });
    }
}
