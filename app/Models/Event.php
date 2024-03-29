<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'name',
        'location',
        'seats',
         'description',
        'created_by',
        'date',
         'category_id',
         'status',
         'image',
        'price',
        'type'
    ];
    protected $dates = ['deleted_at'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class, 'event_id', 'id');
    }
}
