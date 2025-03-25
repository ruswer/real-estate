<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'property_type_id',
        'property_agent_id',
        'title',
        'description',
        'price',
        'location',
        'is_for_rent',
        'is_for_sale'
    ];

    // Mulkning egasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mulk turi
    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    // Agent
    public function agent()
    {
        return $this->belongsTo(PropertyAgent::class, 'property_agent_id');
    }
}
