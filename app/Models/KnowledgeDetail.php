<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'knowledge_id',
        'symptom_id',
    ];

    public function symptom()
    {
        return $this->belongsTo(Symptom::class);
    }
}
