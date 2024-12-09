<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    use HasFactory;

    protected $table = 'knowledges';

    protected $fillable = [
        'disease_id',
    ];

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    public function details()
    {
        return $this->hasMany(KnowledgeDetail::class);
    }
}
