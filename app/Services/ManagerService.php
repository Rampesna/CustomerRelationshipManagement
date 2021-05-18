<?php

namespace App\Services;

use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerService
{
    private $manager;

    /**
     * @return Manager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param Manager $manager
     */
    public function setManager(Manager $manager): void
    {
        $this->manager = $manager;
    }

    public function save(Request $request)
    {
        $this->manager->customer_id = $request->customer_id;
        $this->manager->name = $request->name;
        $this->manager->email = $request->email;
        $this->manager->phone_number = $request->phone_number;
        $this->manager->gender = $request->gender;
        $this->manager->birth_date = $request->birth_date;
        $this->manager->department_id = $request->department_id;
        $this->manager->title_id = $request->title_id;
        $this->manager->save();

        return $this->manager;
    }
}
