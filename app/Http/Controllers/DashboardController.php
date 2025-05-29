<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Masyarakat;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Retrieves the total count of Kriteria and Masyarakat records.
     * Passes this data to the dashboard view.
     *
     * @return View Returns the dashboard view with the total counts of Kriteria and Masyarakat.
     */
    public function index(): View
    {
        $kriteria = Kriteria::all()->count();
        $masyarakat = Masyarakat::all()->count();

        return view('dashboard')->with([
            'title' => 'Dashboard',
            'kriteria' => $kriteria,
            'masyarakat' => $masyarakat,
        ]);
    }
}
