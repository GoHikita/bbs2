<?php

namespace App\Policies;
use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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

    public function edit(User $user, Post $post)
     {
       //dump($user->id);
       //dd($post->user_id);
       return $user->id == $post->user_id;
     }

   public function update(User $user, Post $post)
     {
         return $user->id == $post->user_id;
     }

     public function destroy(User $user, Post $post)
       {
           return $user->id == $post->user_id;
       }

       public function before($user, $ability)
   {
       return $user->isAdmin() ? true : null;
   }

}
