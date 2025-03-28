<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Photo;
use App\Models\PropertyAgent;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'role_id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function isAdmin()
    {
        return $this->role->name === 'admin';
    }

    public function isAgent()
    {
        return $this->role->name === 'agent';
    }

    public function isUser()
    {
        return $this->role->name === 'user';
    }
    public function agent()
    {
        return $this->hasOne(PropertyAgent::class);
    }
    
     // Polimorfik aloqani o'rnatish
    public function image()
    {
       return $this->morphOne(Photo::class, 'imageable');
    }
    
}
