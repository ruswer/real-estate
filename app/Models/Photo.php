<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    /**
     * Polimorfik aloqani o'rnatish
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
