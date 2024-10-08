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
        $this->manager->created_by = $request->id ? $this->manager->created_by : $request->auth_user_id;
        $this->manager->last_updated_by = $request->auth_user_id;
        $this->manager->save();

        return $this->manager;
    }

    public function saveWithData(
        $customerId,
        $name,
        $email,
        $phoneNumber,
        $authUserId
    )
    {
        $this->manager->customer_id = $customerId;
        $this->manager->name = $name;
        $this->manager->email = $email;
        $this->manager->phone_number = $phoneNumber;
        $this->manager->created_by = $this->manager->id ? $this->manager->created_by : $authUserId;
        $this->manager->last_updated_by = $authUserId;
        $this->manager->save();

        return $this->manager;
    }
}
