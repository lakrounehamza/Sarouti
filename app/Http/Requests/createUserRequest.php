<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class createUserRequest extends FormRequest
{
    public function autorize(){
        return  true;
    }
// 'name' => 'required',
//              'email' => 'required',
//              'password' => 'required',
//              'role' => 'required',
//              'phone' => 'required',
//              'photo' => 'required',


}
