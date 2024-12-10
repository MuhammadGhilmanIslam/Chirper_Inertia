<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hashtag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function chirps()
    {
        return $this->belongsToMany(Chirp::class);
    }
}
