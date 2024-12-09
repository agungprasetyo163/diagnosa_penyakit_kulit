<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'code',
        'image',
        'treatment',
    ];

    public function disease_symptoms()
    {
        return $this->hasMany(DiseaseSymptom::class, 'disease_id');
    }
}
