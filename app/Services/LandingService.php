<?php

namespace App\Services;

use App\Repositories\DiseaseCertaintyRepository;

class LandingService
{
    private DiseaseCertaintyRepository $diseaseCertaintyRepository;

    function __construct(DiseaseCertaintyRepository $diseaseCertaintyRepository)
    {
        $this->diseaseCertaintyRepository = $diseaseCertaintyRepository;
    }

    public function getDiseasesInfoData(): array
    {
        $diseases = $this->diseaseCertaintyRepository->getDiseases();

        return ['diseases' => $diseases];
    }
}
