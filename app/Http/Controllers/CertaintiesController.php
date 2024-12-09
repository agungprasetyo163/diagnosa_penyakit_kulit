<?php

namespace App\Http\Controllers;

use App\Models\Certainty;
use Illuminate\Http\Request;

class CertaintiesController extends Controller
{
    public function list()
    {
        $certainties = Certainty::orderBy('score', 'asc')->get()->toArray();

        return view('dashboard.certainties-list')->with([
            'certainties' => $certainties,
        ]);
    }

    public function createCertainty()
    {
        return view('dashboard.certainty-create');
    }

    public function saveCertainty(Request $request)
    {
        $certainty = new Certainty([
            'label' => $request->label,
            'score' => $request->score,
        ]);

        if ($certainty->save()) {
            $request->session()->flash('success', 'Tingkat keyakinan berhasil ditambahkan!');
        } else {
            $request->session()->flash('error', 'Tingkat keyakinan gagal ditambahkan!');
        }

        return redirect()->route('master.certainties.list');
    }

    public function edit(Request $request, Certainty $certainty)
    {
        return view('dashboard.certainty-edit')->with([
            'certainty' => $certainty->toArray(),
        ]);
    }

    public function update(Request $request, Certainty $certainty)
    {
        $certainty->label = $request->label;
        $certainty->score = $request->score;

        if ($certainty->update()) {
            $request->session()->flash('success', 'Berhasil diedit!');
        } else {
            $request->session()->flash('error', 'Gagal diedit!');
        }

        return redirect()->route('master.certainties.list');
    }

    public function confirmDelete(string $id)
    {
        return view('dashboard.certainty-confirm-delete')->with([
            'id' => $id,
        ]);
    }

    public function delete(Request $request, Certainty $certainty)
    {
        if ($certainty->delete()) {
            $request->session()->flash('success', 'Berhasil dihapus!');
        } else {
            $request->session()->flash('error', 'Gagal dihapus!');
        }

        return redirect()->route('master.certainties.list');
    }
}
