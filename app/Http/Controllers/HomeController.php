<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {   
        $events =Event::latest()->paginate(5);

        $categories = Category::all();
        $users=User::all();
        
        return view('home',compact('events', 'categories','users'))->with('i', (request()->input('page', 1) - 1) * 5);;
    }
}
