<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
  public function edit(User $user)
   {
  
     return view('users.edit', ['user' => $user]);
}
