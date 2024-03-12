<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnValue;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Check if the user is authenticated and has the required roles
        if (!$user || !$user->hasAnyRole(['admin', 'organiser'])) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::count();
        $categories = Category::count();
        $events = Event::count();
        $reservations = Reservation::count();

        return view('dashboard', compact('users', 'categories', 'events', 'reservations'));
    }
}
