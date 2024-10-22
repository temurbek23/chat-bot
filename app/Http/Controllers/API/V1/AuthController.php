<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function loginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $phone = trim($request->phone);
        $user = User::where('phone', $phone)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('index');
            } else {
                return redirect()->back()->with([
                    'message' => 'Parol xato kiritildi',
                    'error' => true,
                ]);
            }
        } else {
            return redirect()->back()->with([
                    'message' => 'Foydalanuvchi topilmadi',
                    'error' => true,
            ]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
