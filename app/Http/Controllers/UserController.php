<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(){
        $user = User::create(request(['name']));
        return $user;
    }

    public function update(Request $request,User $user){
        $user = User::find($user->id);
        if($user){
            $user->name = $request->name;
            $user->save();
            return $user;
        }else{
            return 'User not found';
        }
    }

    public function getUsers(){
        $users = User::all();
        return $users;
    }

    public function destroy(User $user){
        $user = User::find($user->id);
        if($user){
            $user->delete();
            return "User deleted successfully";
        }else{
            return "User not found";
        }
    }

    public function completeDay(User $user){
        $user = User::find($user->id);
        if(!$user){
            return "user not found";
        }

        if($user->daily_tasks != true){
            $user->daily_tasks = true;
            $user->save();
            return $user;
        }else{
            $user->daily_tasks = false;
            $user->save();
            return $user;
        }

    }
}
