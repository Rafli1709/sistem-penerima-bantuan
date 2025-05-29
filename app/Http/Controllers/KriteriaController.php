<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Kriteria;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Retrieves all Kriteria records and passes them to the view.
     * Displays a list of Kriteria data in the 'kriteria.index' view.
     *
     * @return View The view to display the list of Kriteria.
     */
    public function index(): View
    {
        $kriteria = Kriteria::all();
        return view('kriteria.index')->with([
            'title' => 'Kelola Data Kriteria',
            'kriteria' => $kriteria,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * Returns the form for adding new Kriteria data with the title "Tambah Data Kriteria".
     *
     * @return View The view for creating new Kriteria data.
     */
    public function create(): View
    {
        return view('kriteria.tambah')->with('title', 'Tambah Data Kriteria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Validates and stores new Kriteria data in the database.
     * After storing, updates the 'bobot' for each Kriteria using ROC method.
     *
     * @param Request $request The request containing Kriteria data.
     * @return RedirectResponse Redirects to the index page with a success message.
     */
    public function store(Request $request): RedirectResponse
    {
        Kriteria::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
        ]);

        $kriteria = Kriteria::all();
        $utils = new Utils();
        $roc = $utils->roc($kriteria->count());
        foreach ($kriteria as $index => $item) {
            $item->update([
                'bobot' => $roc[$index],
            ]);
        }

        return to_route('kriteria.index')->with('message', 'Berhasil Menambahkan Data Kriteria');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * Returns the form for editing existing Kriteria data.
     *
     * @param Kriteria $kriteria The Kriteria model.
     * @return View The view for editing Kriteria data.
     */
    public function edit(Kriteria $kriteria): View
    {
        return view('kriteria.ubah')->with([
            'title' => 'Ubah Data Kriteria',
            'kriteria' => $kriteria,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * Updates an existing Kriteria record.
     *
     * @param Request $request The request containing updated Kriteria data.
     * @param Kriteria $kriteria The Kriteria model.
     * @return RedirectResponse Redirects to the Kriteria index page with a success message.
     */
    public function update(Request $request, Kriteria $kriteria): RedirectResponse
    {
        $kriteria->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
        ]);

        return to_route('kriteria.index')->with('message', 'Berhasil Mengupdate Data Kriteria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * Deletes the specified Kriteria record and recalculates the ROC weights.
     *
     * @param Kriteria $kriteria The Kriteria model.
     * @return RedirectResponse Redirects to the Kriteria index page with a success message.
     */
    public function destroy(Kriteria $kriteria): RedirectResponse
    {
        $kriteria->delete();

        $kriteria = $kriteria->all();
        $utils = new Utils();
        $roc = $utils->roc($kriteria->count());
        foreach ($kriteria as $index => $item) {
            $item->update([
                'bobot' => $roc[$index],
            ]);
        }

        return to_route('kriteria.index')->with('message', 'Berhasil Menghapus Data Kriteria');
    }
}
