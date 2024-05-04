<?php

namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $filter_search = request('search');

        $usersQuery = User::orderBy('created_at', 'desc');

        if($filter_search){
            $usersQuery->where(function($query) use ($filter_search) {
                $query->orWhere('name', 'like', '%'.$filter_search.'%');
                $query->orWhere('email', 'like', '%'.$filter_search.'%');
            });
        }

        $users = $usersQuery->paginate(20);

        return Inertia::render('Dashboard/User/Index', compact('users'));
    }

    /**
     *
     */
    public function ban(User $user){
        if($user->role == 2){
            //ban
            $user->role = 3;
            $user->save();
        }else{
            // unban
            $user->role = 2;
            $user->save();
        }

        return to_route('user.index')->with('message', $user->name.' ha sido baneado con exito.');
    }
}
