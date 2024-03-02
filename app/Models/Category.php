<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable =['name', 'description','image'];

    public function events(){
        return $this->hasMany(Event::class, 'category_id', 'id');
    }

    public static function boot(){
        parent::boot();
        static::deleting(function(Category $categories){
            $categories->events()->delete();
        });
    }
}
