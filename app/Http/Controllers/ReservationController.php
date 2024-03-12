<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Event;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($eventId)
    {
        $user = Auth::user();

        // Check if the user is authenticated and has the required roles
        if (!$user || !$user->hasAnyRole(['admin', 'organiser'])) {
            abort(403, 'Unauthorized action.');
        }
        $event = Event::findOrFail($eventId);
        $reservations = Reservation::where('event_id', $event->id)->latest()->paginate(5);
        $users = User::all();
        return view('reservations.index', compact('event', 'reservations', 'users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreReservationRequest $request)
    // {
    //     //
    // }

    public function book(Request $request, Reservation $reservation)
    {
        $eventId = $request->input('event_id');
        $existingReservation = Reservation::where('user_id', auth()->user()->id)
            ->where('event_id', $eventId)
            ->first();

        if ($existingReservation) {
            $existingReservation->increment('number');
        } else {
            Reservation::create([
                'number' => 1,
                // 'status' => 'pending',
                'user_id' => auth()->user()->id,
                'event_id' => $eventId,
            ]);
        }
        Alert::success('success', 'Reservation created successfully');
        return redirect()->route('home');
        // ->with('success', 'Reservation updated/created successfully')
    }

    // public function changeStatus(Request $request, $reservationId)
    // {
    //     $users = User::all();
    //     $reservation = Reservation::findOrFail($reservationId);
    //     $event = Event::findOrFail($reservation->event_id);

    //     $request->validate([
    //         'status' => 'required|in:pending,accepted,refused',
    //     ]);

    //     $reservation->update(['status' => $request->status]);

    //     $reservations = Reservation::where('event_id', $event->id)->latest()->paginate(5);

    //     return redirect()->route('reservations.index', compact('event', 'reservations', 'users'))
    //         ->with('success', 'Reservation status updated successfully.');
    // }

    public function changeStatus(Request $request, Reservation $reservation)
    {
        $user = Auth::user();

        // Check if the user is authenticated and has the required roles
        if (!$user || !$user->hasAnyRole(['admin', 'organiser'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $status = $request->validate([
            'status' => ['required', 'in:pending,accepted,refused'],
        ]);

        $reservation->update(['status' => $status['status']]);
    
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function myReservations(){
        $reservations=Reservation::where('user_id', auth()->user()->id)->latest()->paginate(5);;
        $payment=Payment::all();
        $events=Event::all();
        return view('Myreservations',compact('reservations','events','payment'))->with('i', (request()->input('page', 1) - 1) * 5);;
    }



    /**
     * Display the specified resource.
     */
    // public function show(Reservation $reservation)
    // {
    //     //
    // }

    // public function destroy(Reservation $reservation)
    // {
    //     //
    // }
}
