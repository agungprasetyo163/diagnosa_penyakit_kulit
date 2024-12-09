<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DiseasesController extends Controller
{
    public function listDiseases()
    {
        return view('dashboard.diseases-list');
    }

    public function createDisease()
    {
        return view('dashboard.disease-create');
    }

    public function saveDisease(Request $request)
    {
        $newFileName = time() . '.' . $request->image->extension();
        Storage::putFileAs('public/diseases', $request->image, $newFileName);

        $symptom = new Disease([
            'name' => $request->name,
            'description' => $request->description,
            'code' => $request->code,
            'treatment' => $request->treatment,
            'image' => $newFileName,
        ]);

        if ($symptom->save()) {
            $request->session()->flash('success', 'Penyakit berhasil ditambahkan!');
        } else {
            $request->session()->flash('error', 'Penyakit gagal ditambahkan!');
        }

        return redirect()->route('master.diseases.list');
    }

    public function editDisease(Request $request, Disease $disease)
    {
        return view('dashboard.disease-edit')->with(['disease' => $disease->toArray()]);
    }

    public function updateDisease(Request $request, Disease $disease)
    {
        $disease->name = $request->name;
        $disease->description = $request->description;
        $disease->code = $request->code;
        $disease->treatment = $request->treatment;

        if ($request->hasFile('image')) {
            $newFileName = time() . '.' . $request->image->extension();
            Storage::putFileAs('public/diseases', $request->image, $newFileName);
            Storage::disk('local')->delete('public/diseases/' . $disease->image);

            $disease->image = $newFileName;
        }

        if ($disease->update()) {
            $request->session()->flash('success', 'Berhasil diedit!');
        } else {
            $request->session()->flash('error', 'Gagal diedit!');
        }

        return redirect()->route('master.diseases.list');
    }

    public function confirmDeleteDisease(Request $request, string $id)
    {
        return view('dashboard.diseases-confirm-delete')->with(['id' => $id]);
    }

    public function deleteDisease(Request $request, Disease $disease)
    {
        if ($disease->delete()) {
            Storage::disk('local')->delete('public/diseases/' . $disease->image);

            $request->session()->flash('success', 'Berhasil dihapus!');
        } else {
            $request->session()->flash('error', 'Gagal dihapus!');
        }

        return redirect()->route('master.diseases.list');
    }

    public function ajaxDiseasesDatatable()
    {
        return DataTables::of(Disease::query())->addIndexColumn()->toJson();
    }
}
