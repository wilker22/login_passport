<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetRequest;
use App\Mail\ForgetMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgetController extends Controller
{
    public function forgetPassword(ForgetRequest $request)
    {
        $email = $request->email;

        if(User::where('email', $email)->doesntExist()){
            return response([
                'message' => "E-mail inválido!",
            ], 401);
        }

        //gera token randômico
        $token = rand(10,100000);

        try{
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token
            ]);

            //envia email com token
            Mail::to($email)->send(new ForgetMail($token));

            return response([
                'message' => "E-mail enviado para você!",
            ], 200);

        }catch(Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
