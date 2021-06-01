<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $userService = new UserService;
        $userService->setUser(User::find($request->id));
        $userService->updateProfile($request);

        return response()->json([
            'type' => 'success',
            'message' => 'Başarıyla Güncellendi'
        ]);
    }

    public function updatePassword(Request $request)
    {
        if ($user = User::find($request->id)) {
            if (Hash::check($request->old_password, $user->password)) {
                $userService = new UserService;
                $userService->setUser($user);
                $userService->updatePassword($request);

                return response()->json([
                    'type' => 'success',
                    'message' => 'Başarıyla Güncellendi'
                ]);
            } else {
                return response()->json([
                    'type' => 'error',
                    'message' => 'Eski Şifreniz Hatalı!'
                ]);
            }
        } else {
            return response()->json([
                'type' => 'error',
                'message' => 'Böyle Bir Kullanıcı Bulunamadı!'
            ]);
        }

    }
}
