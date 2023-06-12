<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetController extends Controller
{
    public function resetPassword(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);

        $emailcheck = DB::table('password_reset_tokens')->where('email', $email)->first();
        $pincheck = DB::table('password_reset_tokens')->where('token', $token)->first();

        if(!$emailcheck){
            return response([
                'message' => "E-mail not found"
            ], 401);
        }
        if(!$pincheck){
            return response([
                'message' => "Pin code invalid"
            ], 401);
        }

        DB::table('users')->where('email', $email)->update(['password' => $password]);
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return response([
            'message' => 'Password change successfully'
        ], 200);

    }
    
}
