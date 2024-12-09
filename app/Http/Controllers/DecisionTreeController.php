<?php

namespace App\Http\Controllers;

use App\Models\DiseaseSymptom;
use App\Models\Knowledge;
use App\Models\Symptom;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DecisionTreeController extends Controller
{
    public function index()
    {
        $diseases = Knowledge::with(['details', 'details.symptom'])->get();

        $symptomId = DB::table('knowledge_details')->select('symptom_id')->get()->map(function ($col) {
            return $col->symptom_id;
        })->toArray();
        $symptoms = Symptom::whereIn('id', $symptomId)->get();

        $gejalas = [];
        foreach ($symptoms as $symptom) {
            $gejalas[$symptom->code] = $symptom->code;
        }
        $gejalas["PENYAKIT"] = "PENYAKIT";

        $dataset = [];
        foreach ($diseases as $disease) {
            if ($disease->details->count() > 0) {
                $gj = [];
                foreach ($disease->details as $ds) {
                    $gj[$ds->symptom->code] = 'Ya';
                }
                $gj['PENYAKIT'] = $disease->disease->code;

                $dataset[] = $gj;
            }
        }

        foreach ($symptoms as $symptom) {
            foreach ($dataset as $i => $dt) {
                if (!array_key_exists($symptom->code, $dt)) {
                    $dataset[$i][$symptom->code] = 'Tidak';
                }
            }
        }

        return view('dashboard.decision-tree-list')->with(['dataset' => $dataset, 'gejalas' => $gejalas]);
    }

    public function ajaxDecisionTreeDatatable()
    {
        return DataTables::of(DiseaseSymptom::with(['symptom', 'disease'])->where('certainty_id', '!=', '1'))
            ->addIndexColumn()
            ->toJson();
    }
}
