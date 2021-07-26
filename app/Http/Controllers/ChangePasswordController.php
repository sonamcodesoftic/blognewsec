<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function store(Request $request, $id)
    // {
    // print_r($request);
    //   $request->validate([
    //      'current_password' => ['required', new MatchOldPassword],
    //      'new_password' => ['required'],
    //      'new_confirm_password' => ['same:new_password'],
    //   ]);
    // //   User::find(auth()->user()->id)
    // //   ->update(['password' => Hash::make($request->new_password)
    // //   ]);
    // //   dd('Password Change Successfully');
    // return User::find($id);
    // //  return $input->update(['password' => Hash::make($request->new_password)]);
    // }   
    

    public function store(Request $request, $id)
    {
        return User::find($id);
    }
    
}