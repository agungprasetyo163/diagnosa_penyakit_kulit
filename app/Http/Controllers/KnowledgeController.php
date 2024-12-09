<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Knowledge;
use App\Models\KnowledgeDetail;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KnowledgeController extends Controller
{
    public function index()
    {
        return view('dashboard.knowledge-list');
    }

    public function create()
    {
        $diseases = Disease::all();
        $symptoms = Symptom::alL();

        return view('dashboard.knowledge-create')->with([
            'diseases' => $diseases,
            'symptoms' => $symptoms,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $knowledge = new Knowledge([
            'disease_id' => $request->name,
        ]);
        $knowledge->save();

        $details = [];
        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'symptom') && $value == 'on') {
                $str = explode('-', $key);
                $details[] = [
                    'knowledge_id' => $knowledge->id,
                    'symptom_id' => $str[1],
                ];
            }
        }

        KnowledgeDetail::insert($details);

        $request->session()->flash('success', 'Berhasil menambahkan pengetahuan!');

        return redirect()->route('master.knowledges.list');
    }

    public function destroy(Request $request, Knowledge $knowledge)
    {
        KnowledgeDetail::where('knowledge_id', '=', $knowledge->id)->delete();

        $knowledge->delete();

        $request->session()->flash('success', 'Berhasil dihapus!');

        return redirect()->route('master.knowledges.list');
    }

    public function ajaxKnowledgeDatatable()
    {
        return DataTables::of(Knowledge::with(['disease', 'details', 'details.symptom']))->addIndexColumn()->toJson();
    }
}
