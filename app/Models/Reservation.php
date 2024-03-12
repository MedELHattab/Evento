<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable=['number','status','user_id','event_id'];



    // public function users(){
    //     return $this->belongsToMany(User::class, 'user_reservation', 'user_id', 'reservation_id');
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
