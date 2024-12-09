<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SymptomsController extends Controller
{
    public function listSymptoms()
    {
        return view('dashboard.symptoms-list');
    }

    public function createSymptom()
    {
        return view('dashboard.symptoms-create');
    }

    public function saveSymptom(Request $request)
    {
        $symptom = new Symptom([
            'name' => $request->name,
            'code' => $request->code,
            'category' => $request->category,
        ]);

        if ($symptom->save()) {
            $request->session()->flash('success', 'Gejala berhasil ditambahkan!');
        } else {
            $request->session()->flash('error', 'Gejala gagal ditambahkan!');
        }

        return redirect()->route('master.symptoms.list');
    }

    public function editSymptom(Request $request, Symptom $symptom)
    {
        return view('dashboard.symptoms-edit')->with(['symptom' => $symptom->toArray()]);
    }

    public function updateSymptom(Request $request, Symptom $symptom)
    {
        $symptom->name = $request->name;
        $symptom->code = $request->code;
        $symptom->category = $request->category;

        if ($symptom->update()) {
            $request->session()->flash('success', 'Berhasil diedit!');
        } else {
            $request->session()->flash('error', 'Gagal diedit!');
        }

        return redirect()->route('master.symptoms.list');
    }

    public function ajaxSymptomsDatatable()
    {
        return DataTables::of(Symptom::query())->addIndexColumn()->toJson();
    }

    public function confirmDeleteSypmtom(Request $request, string $id)
    {
        return view('dashboard.symptoms-confirm-delete')->with(['id' => $id]);
    }

    public function deleteSypmtom(Request $request, Symptom $symptom)
    {
        if ($symptom->delete()) {
            $request->session()->flash('success', 'Berhasil dihapus!');
        } else {
            $request->session()->flash('error', 'Gagal dihapus!');
        }

        return redirect()->route('master.symptoms.list');
    }
}
