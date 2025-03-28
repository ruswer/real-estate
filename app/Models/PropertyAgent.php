<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;

class PropertyAgent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'designation',
        'facebook',
        'twitter',
        'instagram',
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function image()
    {
        return $this->morphOne(Photo::class, 'imageable'); 
    }

}
