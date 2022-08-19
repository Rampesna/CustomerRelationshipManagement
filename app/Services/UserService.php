<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    private $user;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function save(Request $request)
    {
        $this->user->name = $request->name;
        $this->user->email = $request->email;
        $this->user->password = $request->password ? bcrypt($request->password) : $this->user->password;
        $this->user->phone_number = $request->phone_number;
        $this->user->role_id = $request->role_id;
        $this->user->save();
        $this->user->companies()->sync($request->companies);

        return $this->user;
    }

    public function updateProfile(Request $request)
    {
        $this->user->name = $request->name;
        $this->user->phone_number = $request->phone_number;
        $this->user->save();

        return $this->user;
    }

    public function updatePassword(Request $request)
    {
        $this->user->password = bcrypt($request->password);
        $this->user->save();

        return $this->user;
    }

    public function getAll()
    {
        return User::all()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
            ];
        });
    }

    public function getById(
        $id
    )
    {
        return User::find($id);
    }

    public function getByEmail(
        $email
    )
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param User $user
     */
    public function generateSanctumToken(
        User $user
    )
    {
        return $user->createToken('userApiToken')->plainTextToken;
    }
}
