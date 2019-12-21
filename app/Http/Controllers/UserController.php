<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
  public function edit(User $user)
   {
     $this->authorize('edit', $user);
     return view('users.edit', ['user' => $user]);
}
