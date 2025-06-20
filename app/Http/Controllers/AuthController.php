<?php

namespace App\Http\Controllers;
use App\Models\student;
use Illuminate\SUpport\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    #This below function takes care of creating a new user..!!!
    public function register(Request $request)
    {
        $fields = $request->validate([
            'Name'=>'required|max:255',
            'Email'=>'required|max:255|unique:students,Email',
            'Age'=>'required|max:2550',
            'Password'=>'required|max:255|confirmed'
        ]);

        $post = student::create([
            'Name'=>$fields['Name'],
            'Email'=>$fields['Email'],
            'Age'=>$fields['Age'],
            'Password'=>Hash::make($fields['Password'])
        ]);
        return [
            'post'=>$post,
            'Message'=>'Registration Successfully Done..!!!',
            'Status'=>200,
        ];
    }

    #This below function takes care of logging-In a existing user..!!!
    public function login(Request $request)
    {
        $request->validate([
            'Email'=>'required|max:255',
            'Password'=>'required|max:255'
        ]);
        $user_search = student::where('Email', $request->Email)->first();
        if(!$user_search || !Hash::check($request->Password, $user_search->Password))
        {
            return [
                'Status'=>404,
                'Message'=>'Invalid Credentials Entered..!!!'
            ];
        }
        $token = $user_search->createToken($user_search->Name);
        return[
            'user_details'=>$user_search,
            'Token'=>$token->plainTextToken,
            "Status"=>200,
            "Message"=>"Login Successfull..!!!"
        ];
    }

    #This below function takes care of logging-Out a existing user..!!!
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'Message'=>'Logout Successfull..!!!',
            'Status'=>200,
        ];
    }
}
