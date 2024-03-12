<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();

        // Check if the user is authenticated and has the required roles
        if (!$user || !$user->hasAnyRole(['admin', 'organiser'])) {
            abort(403, 'Unauthorized action.');
        }
        $events = auth()->user()->events()->with('category')->latest()->paginate(5);

        $categories = Category::all();
        $reservations=Reservation::all();
        $counts=Reservation::count();

        return view('events.index', compact('events', 'categories','counts','reservations'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function allEvents()
    {
        $events = Event::latest()->paginate(5);
        $categories = Category::all();
        $users = User::all();
        // dd($users);
        return view('events.AllEvents', compact('events', 'categories', 'users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function changeStatus(Request $request, Event $event)
    {
        
        $status = $request->validate([
            'status' => ['required', 'in:pending,accepted,refused'],
        ]);

        $event->update(['status' => $status['status']]);
    
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {  $user = Auth::user();

        // Check if the user is authenticated and has the required roles
        if (!$user || !$user->hasAnyRole(['admin', 'organiser'])) {
            abort(403, 'Unauthorized action.');
        }
        $categories = Category::all();
        return view('events.create', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $user = Auth::user();

        // Check if the user is authenticated and has the required roles
        if (!$user || !$user->hasAnyRole(['admin', 'organiser'])) {
            abort(403, 'Unauthorized action.');
        }
        $imageFileName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageFileName = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/events/';
            $file->move($path, $imageFileName);
        }

        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'seats' => $request->seats,
            'price' => $request->price,
            'date' => $request->date,
            'type' => $request->type,
            'category_id' => $request->category,
            'image' => $imageFileName,
            'created_by' => auth()->id(),
        ]);

        if ($request->type === 'automatic') {
            $event->reservations()->update(['status' => 'accepted']);
        } else {
            
            $event->reservations()->update(['status' => 'pending']);
        }


        return redirect()->route('events')->with('success', 'Event created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::find($id);
        $categories = Category::all();
        $users=User::all();

        // You might want to add some error handling in case the announcement is not found
        if (!$event) {
            abort(404, 'Event not found');
        }

        $categories = Category::all();

        return view('events.show', compact('event', 'categories','users'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {

        $user = Auth::user();

        // Check if the user is authenticated and has the required roles
        if (!$user || !$user->hasAnyRole(['admin', 'organiser'])) {
            abort(403, 'Unauthorized action.');
        }
        $categories = Category::all();

        return view('events.edit', compact('event', 'categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $user = Auth::user();

        // Check if the user is authenticated and has the required roles
        if (!$user || !$user->hasAnyRole(['admin', 'organiser'])) {
            abort(403, 'Unauthorized action.');
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'seats' => $request->seats,
            'price' => $request->price,
            'date' => $request->date,
            'type' => $request->type,
            'category_id' => $request->category,
            'created_by' => auth()->id(),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/events/';
            $file->move($path, $fileName);
            $data['image'] = $fileName;
        }

        if ($request->type === 'automatic') {
            $event->reservations()->update(['status' => 'accepted']);
        } else {
            
            $event->reservations()->update(['status' => 'pending']);
        }

        $event->update($data);

        return redirect()->route('events')->with('success', 'Event updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {  
        $user = Auth::user();

        // Check if the user is authenticated and has the required roles
        if (!$user || !$user->hasAnyRole(['admin', 'organiser'])) {
            abort(403, 'Unauthorized action.');
        }
        $event->delete();

        return redirect()->route('events')
            ->with('success', 'Event deleted successfully');
    }

    public function archive()
    {
        $user = Auth::user();

        // Check if the user is authenticated and has the required roles
        if (!$user || !$user->hasAnyRole(['admin', 'organiser'])) {
            abort(403, 'Unauthorized action.');
        }
        $events = Event::where('created_by', auth()->id())
            ->with('category')
            ->latest()
            ->onlyTrashed()
            ->paginate(5);
        $categories = Category::all();

        return view('events.archive', compact('events', 'categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

}
