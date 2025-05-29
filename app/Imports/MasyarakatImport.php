<?php

namespace App\Imports;

use App\Models\Kriteria;
use App\Models\Masyarakat;
use App\Models\SubKriteria;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MasyarakatImport implements ToCollection
{
    /**
     * Handle the collection of rows from the imported file.
     *
     * This function processes each row from the uploaded Excel file. It creates new Masyarakat records
     * and maps the data to corresponding Kriteria and SubKriteria values.
     *
     * @param Collection $rows The collection of rows from the Excel file.
     * @return void
     */
    public function collection(Collection $rows): void
    {
        $rows->shift();
        $kriteria = Kriteria::all()->count();
        foreach ($rows as $row) {
            $masyarakat = Masyarakat::create([
                'nama' => $row[1],
                'hubungan_keluarga' => $row[2],
            ]);

            for ($i = 0; $i < $kriteria; $i++) {
                $value = $row[$i + 3];
                $kriteria_name = null;
                if ($i == 0) {
                    $newValue = Str::replace('.', '', $value);
                    $intValue = intval(trim($newValue));
                    if ($intValue < 500000) {
                        $value = '< 500.000';
                    } else if ($intValue < 1000000) {
                        $value = '500.000 - 1.000.000';
                    } else if ($intValue < 2000000) {
                        $value = '1.000.000 - 2.000.000';
                    } else {
                        $value = '> 2.000.000';
                    }
                } else if ($i == 2) {
                    $kriteria_name = "Khusus 2";
                } else if ($i == 4) {
                    $intValue = intval(trim($value));
                    if ($intValue > 50) {
                        $value = '> 50 Tahun';
                    } else if ($intValue > 35) {
                        $value = '36 - 50 Tahun';
                    } else if ($intValue > 25) {
                        $value = '26 - 35 Tahun';
                    } else {
                        $value = '<= 25 Tahun';
                    }
                } else if ($i == 5) {
                    $kriteria_name = "Khusus 3";
                } else if ($i == 6) {
                    $kriteria_name = "Khusus 1";
                } else if ($i == 7) {
                    $intValue = intval(trim($value));
                    if ($intValue > 4) {
                        $value = '> 5 Tanggungan';
                    } else if ($intValue > 2) {
                        $value = '3 - 4 Tanggungan';
                    } else if ($intValue > 0) {
                        $value = '1 - 2 Tanggungan';
                    } else {
                        $value = 'Tidak Ada Tanggungan';
                    }
                }

                if ($kriteria_name) {
                    $subkriteria = SubKriteria::where('nama', $value)
                        ->whereHas('kriteria', function ($query) use ($kriteria_name) {
                            $query->where('nama', $kriteria_name);
                        })->first();
                } else {
                    $subkriteria = SubKriteria::where('nama', $value)->first();
                }

                $masyarakat->penilaian()->create([
                    'kriteria_id' => $subkriteria->kriteria_id,
                    'sub_kriteria_id' => $subkriteria->id,
                ]);
            }
        }
    }
}
