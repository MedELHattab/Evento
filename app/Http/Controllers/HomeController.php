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

    public function  search(Request $request){
        if($request->category){
           $events = Event::with("user","category")->where("name","like",'%'.$request->search_string.'%')->Where("category_id",$request->category)->get();
   
       }else $events = Event::with("user","category")->where("name","like",'%'.$request->search_string.'%')->where("status","accepted")->get();
   
       if($events->count()) return response()->json([
           "status" => true
           ,
           "events" => $events
           ,
           "token"  => $request->header("X-CSRF-TOKEN")
       ]);
       else  return response()->json([
           "status" => false
       ]);
       }
   }
