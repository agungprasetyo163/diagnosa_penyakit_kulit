<?php

namespace App\Repositories;

use App\Models\Certainty;
use App\Models\Disease;
use App\Models\Symptom;
use Illuminate\Support\Facades\DB;

class DiseaseCertaintyRepository
{

    function __construct()
    {
    }

    public function getDiseasesWithSymptomsCertainty()
    {
        return Disease::with(['disease_symptoms', 'disease_symptoms.symptom', 'disease_symptoms.certainty'])
            ->get()
            ->toArray();
    }

    public function getCertainties()
    {
        return Certainty::all()->toArray();
    }

    public function getSymptoms()
    {
        return Symptom::all()->toArray();
    }

    public function getDiseases()
    {
        return Disease::all()->toArray();
    }

    public function deleteAllSymptomsCertainty(string $diseaseId)
    {
        DB::table('diseases_symptoms')->where('disease_id', $diseaseId)->delete();
    }

    public function assignSymptomCertainties(string $diseaseId, array $symptomCertainties)
    {
        $insertData = [];
        foreach ($symptomCertainties as $symptom => $certainty) {
            $insertData[] = [
                'disease_id' => $diseaseId,
                'symptom_id' => $symptom,
                'certainty_id' => $certainty,
            ];
        }

        DB::table('diseases_symptoms')->insert($insertData);
    }
}
