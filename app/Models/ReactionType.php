<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReactionType extends Model
{
    use HasFactory;

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }
}
