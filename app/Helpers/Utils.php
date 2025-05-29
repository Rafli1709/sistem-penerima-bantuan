<?php

namespace App\Helpers;

use App\Models\Kriteria;
use App\Models\Masyarakat;

class Utils
{
    /**
     * Convert a date from Y-m-d format to Indonesian date format (e.g., 15 Januari 2023).
     *
     * @param string $dateString The date in 'Y-m-d' format.
     * @return string The formatted Indonesian date.
     */
    public function convertDate($dateString): string
    {
        $date = date_create_from_format('Y-m-d', $dateString);

        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $indonesianDate = date_format($date, 'j ') . $monthNames[(int)date_format($date, 'n')] . date_format($date, ' Y');
        return $indonesianDate;
    }

    /**
     * Format a decimal number, removing trailing zeros.
     *
     * @param float $value The decimal value to format.
     * @return string The formatted decimal string.
     */
    function formatDecimalNumber($value): string
    {
        return rtrim(rtrim(number_format($value, 4), '0'), '.');
    }

    /**
     * Generate a list of ROC weights for a given number.
     *
     * @param int $number The number of iterations to generate ROC weights.
     * @return array The array of ROC weights.
     */
    public function roc($number): array
    {
        $result = [];
        for ($i = 1; $i <= $number; $i++) {
            $weight = 0;
            for ($j = $i; $j <= $number; $j++) {
                $weight += 1 / $j;
            }
            $result[] = $weight / $number;
        }

        return $result;
    }

    /**
     * Get the weight values for all Kriteria.
     * Converts 'Cost' criteria weights to negative.
     *
     * @return array The weight values for each Kriteria.
     */
    public function get_weight(): array
    {
        $kriteria = Kriteria::all();

        // Proses Mengubah Bobot Cost menjadi minus
        $weight = [];
        foreach ($kriteria as $element) {
            if ($element->jenis == "Cost") {
                $element->bobot = $element->bobot * -1;
            }
            $weight[$element->id] = $element->bobot;
        }

        return $weight;
    }

    /**
     * Perform the Weighted Product (WP) method to calculate final scores for Masyarakat.
     *
     * The process includes:
     * - Building the comparison matrix for Masyarakat.
     * - Calculating the 'nilai_s' (S value).
     * - Calculating the 'nilai_v' (V value).
     * - Updating the 'nilai_s' and 'nilai_v' in the Masyarakat table.
     *
     * @return void
     */
    public function wp(): void
    {
        $dataMasyarakat = Masyarakat::with(['penilaian' => function ($query) {
            $query->orderBy('kriteria_id')->with('subKriteria');
        }])->get();
        $weight = $this->get_weight();

        // Proses Pembuatan Matriks Perbandingan
        $matrixMasyarakat = [];
        foreach ($dataMasyarakat as $element) {
            $temp = [];
            foreach ($element->penilaian as $item) {
                $temp[$item->kriteria_id] = $item->subKriteria->nilai;
            }
            $matrixMasyarakat[$element->id] = $temp;
        }

        // Proses Perhitungan Nilai S
        $masyarakat = [];
        $s_sum = 0;
        foreach ($matrixMasyarakat as $id => $data) {
            $s_value = 1;
            foreach ($data as $key => $value) {
                $s_value *= ($value ** $weight[$key]);
            }
            $masyarakat[$id] = $s_value;
            $s_sum += $s_value;
        }

        // Proses Perhitungan Nilai V dan Menyimpan Hasil Nilai Akhir
        foreach ($dataMasyarakat as $element) {
            $element->update([
                'nilai_s' => $masyarakat[$element->id],
                'nilai_v' => $masyarakat[$element->id] / $s_sum,
            ]);
        }
    }
}
