<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Kriteria;
use App\Models\Masyarakat;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Retrieves all Kriteria and Masyarakat data, sorts Masyarakat by nilai_v,
     * calculates the sum of nilai_s, and passes these values to the view.
     *
     * @return View The view to display the Masyarakat data and calculations.
     */
    public function index(): View
    {
        $kriteria = Kriteria::all();

        $masyarakat = Masyarakat::with(['penilaian' => function ($query) {
            $query->orderBy('kriteria_id')->with('subKriteria');
        }])->get();
        $sortMasyarakat = Masyarakat::orderBy('nilai_v', 'desc')->get();
        $s_sum = Masyarakat::sum('nilai_s');

        $utils = new Utils();
        $weight = $utils->get_weight();

        return view('perhitungan.index')->with([
            'title' => 'Perhitungan Metode Maut',
            'masyarakat' => $masyarakat,
            'sortMasyarakat' => $sortMasyarakat,
            'kriteria' => $kriteria,
            'weight' => $weight,
            's_sum' => $s_sum,
        ]);
    }

    /**
     * Perform the calculation and update the Masyarakat data.
     *
     * Uses the wp() method from the Utils helper to perform the calculations,
     * and then redirects to the perhitungan index page with a success message.
     *
     * @return RedirectResponse Redirects to the Perhitungan index page with a success message.
     */
    public function hitung(): RedirectResponse
    {
        $utils = new Utils();
        $utils->wp();

        return to_route('perhitungan.index')->with('message', 'Berhasil Menambahkan Data Pengaduan');
    }
}
