<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certainty extends Model
{
    use HasFactory;

    public $fillable = [
        'label', 'score',
    ];
}
