<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['title','location','seats', 'description', 'category_id', 'image'];
    protected $dates = ['deleted_at'];

    public function company(){
        return $this->belongsTo(Category::class);
    }

    
    public function users(){
        return $this->belongsToMany(User::class, 'user_event', 'user_id', 'event_id');
    }
}
