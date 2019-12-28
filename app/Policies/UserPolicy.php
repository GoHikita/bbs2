<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, User $model)
   {
       return $user->id == $model->id;
   }

    public function update(User $user, User $model)
     {
         return $user->id == $model->id;
     }

     public function destroy(User $user, User $model)
      {
          return $user->id == $model->id;
      }

      public function before($user, $ability)
   {
       return $user->isAdmin() ? true : null;
   }
}
