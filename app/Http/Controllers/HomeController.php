<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Symptom;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $diseases = Disease::count();
        $symptoms = Symptom::count();

        $data = [
            'users' => $users,
            'diseases' => $diseases,
            'symptoms' => $symptoms,
            'knowledge' => $diseases + $symptoms,
        ];

        return view('home', compact('data'));
    }
}
