<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseSymptom extends Model
{
    use HasFactory;

    protected $table = 'diseases_symptoms';

    public $fillable = [
        'score',
    ];

    public function symptom()
    {
        return $this->hasOne(Symptom::class, 'id', 'symptom_id');
    }

    public function disease()
    {
        return $this->hasOne(Disease::class, 'id', 'disease_id');
    }

    public function certainty()
    {
        return $this->hasOne(Certainty::class, 'id', 'certainty_id');
    }
}
