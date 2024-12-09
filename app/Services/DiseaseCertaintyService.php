<?php

namespace App\Services;

use App\Repositories\DiseaseCertaintyRepository;

class DiseaseCertaintyService
{
    private DiseaseCertaintyRepository $diseaseCertaintyRepository;

    function __construct(DiseaseCertaintyRepository $diseaseCertaintyRepository)
    {
        $this->diseaseCertaintyRepository = $diseaseCertaintyRepository;
    }

    public function getPredictionFormData(): array
    {
        $certainties = $this->diseaseCertaintyRepository->getCertainties();
        $symptoms = $this->diseaseCertaintyRepository->getSymptoms();

        return [
            'certainties' => $certainties,
            'symptoms' => $symptoms,
        ];
    }

    public function rankLikelyDisease(array $userSymptomCertainties): array
    {
        $diseases = $this->diseaseCertaintyRepository->getDiseasesWithSymptomsCertainty();
        $diseases = $this->flattenDiseasesArray($diseases);

        $diseasePercentages = $this->calculateCertaintyPercentage($diseases, $userSymptomCertainties);
        $diseasePercentages = $this->sortRankedDiseases($diseasePercentages);
        $diseasePercentages = array_slice($diseasePercentages, 0, 5);

        return $diseasePercentages;
    }

    public function assignSymptomCertainty(string $diseaseId, array $symptomCertaintyPairs)
    {
        $this->diseaseCertaintyRepository->deleteAllSymptomsCertainty($diseaseId);
        $this->diseaseCertaintyRepository->assignSymptomCertainties($diseaseId, $symptomCertaintyPairs);
    }

    private function flattenDiseasesArray(array $diseases): array
    {
        $flattenDisease = [];
        foreach ($diseases as $disease) {
            $certainties = [];

            foreach ($disease['disease_symptoms'] as $certainty) {
                $certainties[$certainty['symptom']['id']] = [
                    'symptom_name' => $certainty['symptom']['name'],
                    'certainty_id' => $certainty['certainty']['id'],
                    'certainty_score' => $certainty['certainty']['score'],
                ];
            }

            $flattenDisease[] = [
                'id' => $disease['id'],
                'name' => $disease['name'],
                'image' => $disease['image'],
                'description' => $disease['description'],
                'treatment' => $disease['treatment'],
                'disease_symptoms' => $certainties,
            ];
        }

        return $flattenDisease;
    }

    private function calculateCertaintyPercentage(array $diseases, array $userSymptomCertainties): array
    {
        $diseasePercentages = [];
        foreach ($diseases as $disease) {
            $scores = [];

            foreach ($disease['disease_symptoms'] as $symptomId => $expertCertainty) {
                $scores[] = $userSymptomCertainties[$symptomId] * $expertCertainty['certainty_score'];
            }

            $percentage = 0;
            if (count($scores) == 1) {
                $percentage = $scores[0] * 100;
            } else if (count($scores) > 1) {
                $combinedScore = $scores[0] + $scores[1] * (1 - $scores[0]);
                for ($i = 2; $i < count($scores); $i++) {
                    $combinedScore = $combinedScore + $scores[$i] * (1 - $combinedScore);
                }
                $percentage = $combinedScore * 100;
            }

            $diseasePercentages[] = [
                'id' => $disease['id'],
                'name' => $disease['name'],
                'image' => $disease['image'],
                'description' => $disease['description'],
                'treatment' => $disease['treatment'],
                'percentage' => number_format((float) $percentage, 2, '.', ''),
            ];
        }

        return $diseasePercentages;
    }

    private function sortRankedDiseases(array $rankedDiseases): array
    {
        $percentages = array_column($rankedDiseases, 'percentage');

        array_multisort($percentages, SORT_DESC, $rankedDiseases);

        return $rankedDiseases;
    }
}
