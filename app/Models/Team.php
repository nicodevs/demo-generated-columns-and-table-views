<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function items()
    {
        return $this->hasManyThrough(Item::class, Player::class);
    }
}
