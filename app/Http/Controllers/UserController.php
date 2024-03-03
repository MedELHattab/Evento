<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(5);
        return view('users.index',compact('users'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function destroy(User $user)
    {   
        $user->delete();
         
        return redirect()->route('users')
                        ->with('success','user deleted successfully');
    }
    public function archive(){
        $users = User::onlyTrashed()->latest()->paginate(5);
        return view('users.archive',compact('users'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
