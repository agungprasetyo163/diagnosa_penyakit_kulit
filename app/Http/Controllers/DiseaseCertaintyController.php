<?php

namespace App\Http\Controllers;

use App\Models\Certainty;
use App\Models\Disease;
use App\Models\Symptom;
use Exception;
use App\Services\DiseaseCertaintyService;
use Illuminate\Http\Request;

class DiseaseCertaintyController extends Controller
{
    private DiseaseCertaintyService $diseaseCertaintyService;

    function __construct(DiseaseCertaintyService $diseaseCertaintyService)
    {
        $this->diseaseCertaintyService = $diseaseCertaintyService;
    }

    public function predictionForm()
    {
        $data = $this->diseaseCertaintyService->getPredictionFormData();

        return view('prediction-form', $data);
    }

    public function predictionResult(Request $request)
    {
        try {
            $results = $this->diseaseCertaintyService->rankLikelyDisease($request->all());

            return view('prediction-result', [
                'results' => $results,
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function assignList()
    {
        return view('dashboard.assignment-list');
    }

    public function assignSymptomCertainties(Request $request, Disease $disease)
    {
        return view('dashboard.disease-assignment')->with([
            'certainties' => Certainty::all()->toArray(),
            'symptoms' => Symptom::all()->toArray(),
            'disease' => $disease->load(['disease_symptoms'])->toArray(),
        ]);
    }

    public function storeSymptomCertaintyAssignments(Request $request, string $diseaseId)
    {
        try {
            $this->diseaseCertaintyService->assignSymptomCertainty($diseaseId, $request->except('_token'));

            $request->session()->flash('success', 'Berhasil assign!');

            return redirect()->route('master.assignments.list');
        } catch (Exception $e) {
            $request->session()->flash('error', 'Gagal assign!');

            return redirect()->route('master.assignments.list');
        }
    }
}
