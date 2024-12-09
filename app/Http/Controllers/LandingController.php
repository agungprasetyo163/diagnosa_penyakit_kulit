<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Services\LandingService;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    private LandingService $landingService;

    function __construct(LandingService $landingService)
    {
        $this->landingService = $landingService;
    }

    public function index()
    {
        return view('landing.home');
    }

    public function diseasesInfo()
    {
        $data = $this->landingService->getDiseasesInfoData();

        return view('landing.disease-info', $data);
    }

    public function diseaseDetail(Disease $disease)
    {
        return view('landing.disease-detail')->with([
            'disease' => $disease
        ]);
    }
}
