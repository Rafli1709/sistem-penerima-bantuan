<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Retrieves all Kriteria with their associated SubKriteria and passes them to the view.
     * Displays a list of SubKriteria data in the 'sub_kriteria.index' view.
     *
     * @return View The view to display SubKriteria data.
     */
    public function index(): View
    {
        $kriteria = Kriteria::with('subKriteria')->get();

        return view('sub_kriteria.index')->with([
            'title' => 'Kelola Data Sub Kriteria',
            'kriteria' => $kriteria,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * Returns the form for adding a new SubKriteria under the specified Kriteria.
     *
     * @param Kriteria $kriteria The Kriteria to associate the new SubKriteria with.
     * @return View The view for creating new SubKriteria data.
     */
    public function create(Kriteria $kriteria): View
    {
        return view('sub_kriteria.tambah')->with([
            'title' => 'Tambah Data Sub Kriteria',
            'kriteria' => $kriteria,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * Validates and stores the new SubKriteria data, then updates the 'nilai' based on ROC method.
     * Redirects to the SubKriteria index page with a success message.
     *
     * @param Request $request The request containing SubKriteria data.
     * @return RedirectResponse Redirects to the SubKriteria index page with a success message.
     */
    public function store(Request $request): RedirectResponse
    {
        SubKriteria::create([
            'kriteria_id' => $request->kriteria_id,
            'nama' => $request->nama,
            'nilai' => $request->nilai,
        ]);

        $subKriteria = SubKriteria::where('kriteria_id', '=', $request->kriteria_id)->get();
        $utils = new Utils();
        $roc = $utils->roc($subKriteria->count());
        foreach ($subKriteria as $index => $item) {
            $item->update([
                'nilai' => $roc[$index],
            ]);
        }

        return to_route('sub-kriteria.index')->with('message', 'Berhasil Menambahkan Data Sub Kriteria');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * Returns the form for editing the specified SubKriteria data.
     *
     * @param SubKriteria $subKriteria The SubKriteria model to edit.
     * @return View The view for editing SubKriteria data.
     */
    public function edit(SubKriteria $subKriteria): View
    {
        return view('sub_kriteria.ubah')->with([
            'title' => 'Ubah Data Sub Kriteria',
            'subKriteria' => $subKriteria,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * Updates an existing SubKriteria record and redirects to the SubKriteria index page with a success message.
     *
     * @param Request $request The request containing updated SubKriteria data.
     * @param SubKriteria $subKriteria The SubKriteria model to update.
     * @return RedirectResponse Redirects to the SubKriteria index page with a success message.
     */
    public function update(Request $request, SubKriteria $subKriteria): RedirectResponse
    {
        $subKriteria->update([
            'nama' => $request->nama,
        ]);

        return to_route('sub-kriteria.index')->with('message', 'Berhasil Mengupdate Data Sub Kriteria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * Deletes the specified SubKriteria record and recalculates the ROC weights for the remaining SubKriteria.
     *
     * @param SubKriteria $subKriteria The SubKriteria model to delete.
     * @return RedirectResponse Redirects to the SubKriteria index page with a success message.
     */
    public function destroy(SubKriteria $subKriteria): RedirectResponse
    {
        $kriteria_id = $subKriteria->kriteria_id;
        $subKriteria->delete();

        $subKriteria = SubKriteria::where('kriteria_id', '=', $kriteria_id)->get();
        $utils = new Utils();
        $roc = $utils->roc($subKriteria->count());
        foreach ($subKriteria as $index => $item) {
            $item->update([
                'nilai' => $roc[$index],
            ]);
        }

        return to_route('sub-kriteria.index')->with('message', 'Berhasil Menghapus Data Sub Kriteria');
    }
}
