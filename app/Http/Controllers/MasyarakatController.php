<?php

namespace App\Http\Controllers;

use App\Imports\MasyarakatImport;
use App\Models\Kriteria;
use App\Models\Masyarakat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Retrieves all Masyarakat data with their penilaian, ordered by kriteria_id.
     * Also loads Kriteria data to be used in the view.
     *
     * @return View The view to display Masyarakat data.
     */
    public function index(): View
    {
        $masyarakat = Masyarakat::with(['penilaian' => function ($query) {
            $query->orderBy('kriteria_id')->with('subKriteria');
        }])->get();

        $kriteria = Kriteria::all();

        return view('masyarakat.index')->with([
            'title' => 'Kelola Data Masyarakat',
            'masyarakat' => $masyarakat,
            'kriteria' => $kriteria,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * Loads Kriteria data with associated subKriteria and passes it to the form for creating new Masyarakat.
     *
     * @return View The view for creating new Masyarakat data.
     */
    public function create(): View
    {
        $kriteria = Kriteria::with('subKriteria')->get();

        return view('masyarakat.tambah')->with([
            'title' => 'Tambah Data Masyarakat',
            'kriteria' => $kriteria,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * Validates and stores Masyarakat data, including associated Kriteria and subKriteria.
     * Then redirects to the Masyarakat index page with a success message.
     *
     * @param Request $request The request containing Masyarakat data.
     * @return RedirectResponse Redirects to the Masyarakat index page with a success message.
     */
    public function store(Request $request): RedirectResponse
    {
        $masyarakat = Masyarakat::create([
            'nama' => $request->nama,
            'hubungan_keluarga' => $request->hubungan_keluarga,
        ]);

        foreach ($request->kriteria as $key => $value) {
            $masyarakat->penilaian()->create([
                'kriteria_id' => $key,
                'sub_kriteria_id' => $value,
            ]);
        }

        return to_route('masyarakat.index')->with('message', 'Berhasil Menambahkan Data Masyarakat');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * Loads the existing Masyarakat data with associated penilaian and subKriteria.
     * Passes Kriteria data to the form for editing.
     *
     * @param Masyarakat $masyarakat The Masyarakat model to edit.
     * @return View The view for editing Masyarakat data.
     */
    public function edit(Masyarakat $masyarakat): View
    {
        $masyarakat->load('penilaian.subKriteria');
        $kriteria = Kriteria::with('subKriteria')->get();

        return view('masyarakat.ubah')->with([
            'title' => 'Ubah Data Masyarakat',
            'masyarakat' => $masyarakat,
            'kriteria' => $kriteria,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * Updates the Masyarakat record and its associated penilaian.
     * Then redirects to the Masyarakat index page with a success message.
     *
     * @param Request $request The request containing updated Masyarakat data.
     * @param Masyarakat $masyarakat The Masyarakat model to update.
     * @return RedirectResponse Redirects to the Masyarakat index page with a success message.
     */
    public function update(Request $request, Masyarakat $masyarakat): RedirectResponse
    {
        $masyarakat->update([
            'nama' => $request->nama,
            'hubungan_keluarga' => $request->hubungan_keluarga,
        ]);

        foreach ($request->kriteria as $key => $value) {
            $masyarakat->penilaian()->where('kriteria_id', $key)->update([
                'sub_kriteria_id' => $value,
            ]);
        }

        return to_route('masyarakat.index')->with('message', 'Berhasil Mengupdate Data Masyarakat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * Deletes the Masyarakat record and redirects to the Masyarakat index page with a success message.
     *
     * @param Masyarakat $masyarakat The Masyarakat model to delete.
     * @return RedirectResponse Redirects to the Masyarakat index page with a success message.
     */
    public function destroy(Masyarakat $masyarakat): RedirectResponse
    {
        $masyarakat->delete();

        return to_route('masyarakat.index')->with('message', 'Berhasil Menghapus Data Masyarakat');
    }

    /**
     * Show the form for importing data.
     *
     * Displays the form for importing Masyarakat data from an Excel file.
     *
     * @return View The view to import Masyarakat data.
     */
    public function import(): View
    {
        return view('masyarakat.import')->with([
            'title' => 'Import Data Masyarakat',
        ]);
    }

    /**
     * Process the import of Masyarakat data from an Excel file.
     *
     * Validates the uploaded file and processes the import using the MasyarakatImport class.
     * Then redirects to the Masyarakat index page with a success message.
     *
     * @param Request $request The request containing the uploaded file.
     * @return RedirectResponse Redirects to the Masyarakat index page with a success message.
     */
    public function processImport(Request $request): RedirectResponse
    {
        $request->validate([
            'import_file' => [
                'required',
                'file',
                'mimes:xls,xlsx,csv',
            ],
        ]);

        Excel::import(new MasyarakatImport, $request->file('import_file'));

        return to_route('masyarakat.index')->with('message', 'Berhasil Mengimport Data Masyarakat');
    }
}
