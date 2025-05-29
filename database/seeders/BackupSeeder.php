<?php

namespace Database\Seeders;

use App\Models\User;
use App\Helpers\Utils;
use App\Models\Kriteria;
use App\Models\Masyarakat;
use App\Models\SubKriteria;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BackupSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        $criterias = [
            [
                'nama' => 'Penghasilan',
                'bobot' => 0.1096,
                'jenis' => 'Cost',
                'subKriteria' => [
                    [
                        'nama' => '> 2.000.000',
                        'nilai' => 0.5208,
                    ],
                    [
                        'nama' => '1.000.000 - 2.000.000',
                        'nilai' => 0.2708,
                    ],
                    [
                        'nama' => '500.000 - 1.000.000',
                        'nilai' => 0.1458,
                    ],
                    [
                        'nama' => '< 500.000',
                        'nilai' => 0.0625,
                    ],
                ],
            ],
            [
                'nama' => 'Kondisi Rumah',
                'bobot' => 0.0846,
                'jenis' => 'Cost',
                'subKriteria' => [
                    [
                        'nama' => 'Permanen',
                        'nilai' => 0.5208,
                    ],
                    [
                        'nama' => 'Semi Permanen',
                        'nilai' => 0.2708,
                    ],
                    [
                        'nama' => 'Rumah Panggung',
                        'nilai' => 0.1458,
                    ],
                    [
                        'nama' => 'Anyaman Bambu',
                        'nilai' => 0.0625,
                    ],
                ],
            ],
            [
                'nama' => 'Khusus 2',
                'bobot' => 0.0211,
                'jenis' => 'Benefit',
                'subKriteria' => [
                    [
                        'nama' => 'Ya',
                        'nilai' => 0.75,
                    ],
                    [
                        'nama' => 'Tidak',
                        'nilai' => 0.25,
                    ],
                ],
            ],

            [
                'nama' => 'Jenis Pekerjaan',
                'bobot' => 0.1429,
                'jenis' => 'Cost',
                'subKriteria' => [
                    [
                        'nama' => 'PNS/TNI',
                        'nilai' => 0.5208,
                    ],
                    [
                        'nama' => 'Wiraswasta/Pegawai Swasta',
                        'nilai' => 0.2708,
                    ],
                    [
                        'nama' => 'Petani/Buruh',
                        'nilai' => 0.1458,
                    ],
                    [
                        'nama' => 'Tidak Bekerja',
                        'nilai' => 0.0625,
                    ],
                ],
            ],
            [
                'nama' => 'Umur',
                'bobot' => 0.2929,
                'jenis' => 'Benefit',
                'subKriteria' => [
                    [
                        'nama' => '> 50 Tahun',
                        'nilai' => 0.5208,
                    ],
                    [
                        'nama' => '36 - 50 Tahun',
                        'nilai' => 0.2708,
                    ],
                    [
                        'nama' => '26 - 35 Tahun',
                        'nilai' => 0.1458,
                    ],
                    [
                        'nama' => '<= 25 Tahun',
                        'nilai' => 0.0625,
                    ],
                ],
            ],
            [
                'nama' => 'Khusus 3',
                'bobot' => 0.01,
                'jenis' => 'Benefit',
                'subKriteria' => [
                    [
                        'nama' => 'Ya',
                        'nilai' => 0.75,
                    ],
                    [
                        'nama' => 'Tidak',
                        'nilai' => 0.25,
                    ],
                ],
            ],
            [
                'nama' => 'Khusus 1',
                'bobot' => 0.0336,
                'jenis' => 'Benefit',
                'subKriteria' => [
                    [
                        'nama' => 'Ya',
                        'nilai' => 0.75,
                    ],
                    [
                        'nama' => 'Tidak',
                        'nilai' => 0.25,
                    ],
                ],
            ],
            [
                'nama' => 'Jumlah Tanggungan',
                'bobot' => 0.1929,
                'jenis' => 'Benefit',
                'subKriteria' => [
                    [
                        'nama' => '> 5 Tanggungan',
                        'nilai' => 0.5208,
                    ],
                    [
                        'nama' => '3 - 4 Tanggungan',
                        'nilai' => 0.2708,
                    ],
                    [
                        'nama' => '1 - 2 Tanggungan',
                        'nilai' => 0.1458,
                    ],
                    [
                        'nama' => 'Tidak Ada Tanggungan',
                        'nilai' => 0.0625,
                    ],
                ],
            ],
            [
                'nama' => 'Sumber Air',
                'bobot' => 0.0479,
                'jenis' => 'Cost',
                'subKriteria' => [
                    [
                        'nama' => 'Air Sumur',
                        'nilai' => 0.6111,
                    ],
                    [
                        'nama' => 'PDAM',
                        'nilai' => 0.2778,
                    ],
                    [
                        'nama' => 'Air Sungai',
                        'nilai' => 0.1111,
                    ],
                ],
            ],
            [
                'nama' => 'Pendidikan',
                'bobot' => 0.0646,
                'jenis' => 'Cost',
                'subKriteria' => [
                    [
                        'nama' => 'Sarjana',
                        'nilai' => 0.5208,
                    ],
                    [
                        'nama' => 'SMA',
                        'nilai' => 0.2708,
                    ],
                    [
                        'nama' => 'SD/SMP',
                        'nilai' => 0.1458,
                    ],
                    [
                        'nama' => 'Tidak Sekolah',
                        'nilai' => 0.0625,
                    ],
                ],
            ],
        ];

        $utils = new Utils();
        $weight = $utils->roc(count($criterias));

        $i = 0;
        foreach ($criterias as $criteriaData) {
            $criteria = Kriteria::create([
                'nama' => $criteriaData['nama'],
                'bobot' => $weight[$i++],
                'jenis' => $criteriaData['jenis'],
            ]);

            $subCriterias = $criteriaData['subKriteria'];
            foreach ($subCriterias as $subCriteria) {
                SubKriteria::create([
                    'nama' => $subCriteria['nama'],
                    'nilai' => $subCriteria['nilai'],
                    'kriteria_id' => $criteria->id,
                ]);
            }
        }

        $data = [
            [
                "nama" => "AGUNG AYU TANGGAL",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 80,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Tidak Sekolah',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "AGUNG BAGUS MEI ANTARA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 40,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "AGUNG PUTU ALIT WIDANA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 38,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "AGUNG PUTU ANGGIL ALFANDI",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 26,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "AGUNG PUTU LEPI DIANA PUTRA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 15,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "ARDI SURYA DHARMA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 19,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "DESAK AYU PUTU LESTARI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 28,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "DEWA GEDA SUSRAWAN",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 15,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "DEWA KETUT SUKERTAYASA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 60,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "DEWA MADE ADHIATMIKA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 15,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "DEWA MADE ALIT",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 48,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "DEWA NYOMAN WANDRA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 83,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "DEWA NYOMAN WIDANA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 39,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "DEWA NYOMAN WIDANA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 39,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "DEWA PUTU SUGITA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 33,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "ERNIATI BASA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 40,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Ya',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "GEDE ARYA MAHARDIKA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 61,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "GEDE FEBRIYAN",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 13,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "GEDE SUMADA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 36,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "GEDE TIRTA MASDIASA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 11,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "GEDE YUDA PRAYANA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 37,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "GURUN LUH NADI",
                "hubungan_keluarga" => "Orang Tua",
                "kriteria" => [
                    'Umur' => 91,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Tidak Sekolah',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Ya',
                ]
            ],
            [
                "nama" => "GUSTI KADE DARMAWAN",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 33,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "GUSTI KOMANG ARIANTO",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 35,
                    'Jumlah Tanggungan' => 2,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "GUSTI KOMANG WIRTA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 59,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "GUSTI PUTU SWASTIKA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 48,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I GEDE AGUS DARMA SANTOSO",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 13,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I GEDE ARYA SUMADA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 30,
                    'Jumlah Tanggungan' => 2,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I GEDE KERTA WIRA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 41,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I GEDE SATRIA WIBAWA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 28,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I GEDE SUBANDA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 64,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '500.000 - 1.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I GEDE SUDARTA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 45,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I GEDE SUMADA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 38,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I GEDE SURANTA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 33,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I GUSTI AGUNG KOMANG DENER",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 81,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Ya',
                ]
            ],
            [
                "nama" => "I GUSTI KOMANG SUNARTO",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 60,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I GUSTI PUTU YUDHI HENDRAWAN",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 25,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KADEK AGUS SUARDIYASA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 30,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KADEK AGUS WIBAWA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 15,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KADEK ARDIKA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 36,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KADEK ARI WARDANA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 15,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KADEK ARTAYASA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 37,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KADEK DARMAYASA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 26,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KADEK OKI AGUSTINA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 15,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KADEK RADIKA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 15,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KADEK SUARDIKA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 41,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KETUT GEDE SUARMAWAN",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 48,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KETUT JELANTIK",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 36,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KETUT MERTA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 51,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KETUT RANDI NUGRAHA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 14,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KETUT SUBAMIA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 48,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KETUT SUNARTA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 46,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KETUT SUWECA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 41,
                    'Jumlah Tanggungan' => 6,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KETUT WARDA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 61,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KETUT WIJANA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 36,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KOMANG ARDIASA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 17,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I KOMANG SUARTANA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 51,
                    'Jumlah Tanggungan' => 6,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE ARI WARDANA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 15,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE ARMAWAN",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 43,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE ARYA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 40,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '500.000 - 1.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE BAGUS ARYA LAKSANA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 9,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE BUDA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 48,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE DITAYASA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 23,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE EKO DARMADI",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 50,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE PASEK BUANA ARTA JAYA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 28,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE PATRA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 67,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE PURNOMO HARIADI",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 36,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE PUTRA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 54,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE RAI MINA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 60,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE RAI SUARSA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 51,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE RAME",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 62,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '500.000 - 1.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE SARMA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 71,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE SEMARANALA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 51,
                    'Jumlah Tanggungan' => 6,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE SUDARTA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 48,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE SUKARMA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 53,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE SUNARDA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 58,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I MADE SURA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 55,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I NENGAH MANDRA",
                "hubungan_keluarga" => "Orang Tua",
                "kriteria" => [
                    'Umur' => 79,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I NENGAH SUARMA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 56,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I NGURAH PANDI SANTOSA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 26,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I NYOMAN BEBAS",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 63,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I NYOMAN DARSANA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 58,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I NYOMAN DENER",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 55,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I NYOMAN EKA BRATA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 38,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I NYOMAN GEDE SUARSA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 49,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I NYOMAN NGURAH SUYANTO",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 35,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I NYOMAN SINOM",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 43,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Ya',
                ]
            ],
            [
                "nama" => "I NYOMAN SUETA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 68,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I NYOMAN WIARTA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 39,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I NYOMAN WIRYA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 37,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I PUTU ARDIKA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 25,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I PUTU ARJUN ADI",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 27,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I PUTU DEDI WARJANA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 27,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I PUTU EKA SUDARSONO",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 36,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I PUTU OKA DIANTARA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 28,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '500.000 - 1.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I PUTU SUARDIKA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 48,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN ARTADANA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 26,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN ASTIKA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 48,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN CATUR",
                "hubungan_keluarga" => "Orang Tua",
                "kriteria" => [
                    'Umur' => 63,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN DEDI PURNOMO",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 35,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN KARTIKA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 52,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN MARAGAMA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 50,
                    'Jumlah Tanggungan' => 6,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN MERTA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 83,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '500.000 - 1.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'Tidak Sekolah',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN RENA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 70,
                    'Jumlah Tanggungan' => 6,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'Tidak Sekolah',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN SRANA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 30,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN SUARNITA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 33,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN SUDIASA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 54,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN SUKANADI",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 46,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN SUTAMA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 57,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "I WAYAN SUWARTO",
                "hubungan_keluarga" => "Orang Tua",
                "kriteria" => [
                    'Umur' => 66,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "IDA AYU KADEK ANGGRAENI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 31,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "INDIRA APRILIYANI",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 8,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Tidak Sekolah',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KADEK ADI SUCIPTO",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 43,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KADEK AGUS HENDRA PRIYANA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 23,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KADEK AYU ASTUTI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 23,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KADEK EDY SUMARLYANTO",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 28,
                    'Jumlah Tanggungan' => 2,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KADEK LANA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 27,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KADEK MULIANA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 55,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KADEK YASNI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 31,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KETUT SUWATRA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 54,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KOMANG ASTAWA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 54,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '500.000 - 1.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KOMANG AYU RAYANI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 31,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KOMANG KURNIAWAN",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 40,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KOMANG SUDARMINI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 35,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "KOMANG SUTARMA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 24,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "MADE SUARSONO",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 48,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '500.000 - 1.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "MADE WITRINI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 34,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "MARLINA SARI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 29,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "MEN KERTI",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 74,
                    'Jumlah Tanggungan' => 6,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '500.000 - 1.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Tidak Sekolah',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NENGAH PUTU MADIANA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 44,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NI KETUT AYU ARIYANTI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 28,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NI KETUT SUARTINI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 49,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NI KOMANG FIFIT PRATIWI",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 24,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NI KOMANG KENI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 30,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NI MADE JUNIARTI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 31,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Sarjana',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NI MADE MURTINI",
                "hubungan_keluarga" => "Orang Tua",
                "kriteria" => [
                    'Umur' => 85,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'Tidak Sekolah',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NI NYOMAN KAWIYANTI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 34,
                    'Jumlah Tanggungan' => 2,
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NI PUTU AYU ANDHINI PUTRI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 27,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NI WAYAN RENJEN",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 84,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'Tidak Sekolah',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NILUH AYU DEWI ASTUTI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 26,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NILUH KAILA NATASYA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 7,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'Tidak Sekolah',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NYOMAN ARIANI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 25,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NYOMAN SANI",
                "hubungan_keluarga" => "Istri",
                "kriteria" => [
                    'Umur' => 80,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '500.000 - 1.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NYOMAN SUASA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 57,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "NYOMAN SUKANDIA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 52,
                    'Jumlah Tanggungan' => 4,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "PAN LUH NURYANTI",
                "hubungan_keluarga" => "Orang Tua",
                "kriteria" => [
                    'Umur' => 81,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '500.000 - 1.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "PUTU ADI PERMANA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 35,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Wiraswasta/Pegawai Swasta',
                    'Penghasilan' => '> 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "PUTU ANDRE JULIANA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 13,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "PUTU ARIYASA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 35,
                    'Jumlah Tanggungan' => 3,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "PUTU ARYA AIRLANGGA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 14,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "PUTU EKA PURWATA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 10,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "PUTU VIERIANTO",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 20,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "PUTU WARTA",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 30,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "RADEN BAGUS SUKARMA",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 65,
                    'Jumlah Tanggungan' => 6,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "RYAN ARTINO",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 23,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "SITTI SATILA RAHMI",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 14,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SD/SMP',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "WAYAN CUET",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 78,
                    'Jumlah Tanggungan' => 6,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '1.000.000 - 2.000.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "WAYAN LACE",
                "hubungan_keluarga" => "Kepala Keluarga",
                "kriteria" => [
                    'Umur' => 86,
                    'Jumlah Tanggungan' => 5,
                    'Jenis Pekerjaan' => 'Petani/Buruh',
                    'Penghasilan' => '500.000 - 1.000.000',
                    'Kondisi Rumah' => 'Semi Permanen',
                    'Pendidikan' => 'Tidak Sekolah',
                    'Sumber Air' => 'PDAM',
                    'Khusus 1' => 'Ya',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
            [
                "nama" => "WAYAN PARIANTO",
                "hubungan_keluarga" => "Anak",
                "kriteria" => [
                    'Umur' => 25,
                    'Jumlah Tanggungan' => '-',
                    'Jenis Pekerjaan' => 'Tidak Bekerja',
                    'Penghasilan' => '< 500.000',
                    'Kondisi Rumah' => 'Permanen',
                    'Pendidikan' => 'SMA',
                    'Sumber Air' => 'Air Sumur',
                    'Khusus 1' => 'Tidak',
                    'Khusus 2' => 'Tidak',
                    'Khusus 3' => 'Tidak',
                ]
            ],
        ];

        foreach ($data as $element) {
            $masyarakat = Masyarakat::create([
                'nama' => Str::title(strtolower($element['nama'])),
                'hubungan_keluarga' => $element['hubungan_keluarga'],
            ]);

            foreach ($element['kriteria'] as $key => $value) {
                if ($key == "Umur") {
                    if ($value > 50) {
                        $value = '> 50 Tahun';
                    } elseif ($value > 35) {
                        $value = '36 - 50 Tahun';
                    } elseif ($value > 25) {
                        $value = '26 - 35 Tahun';
                    } else {
                        $value = '<= 25 Tahun';
                    }
                } elseif ($key == "Jumlah Tanggungan") {
                    if ($value > 4) {
                        $value = '> 5 Tanggungan';
                    } elseif ($value > 2) {
                        $value = '3 - 4 Tanggungan';
                    } elseif ($value > 0) {
                        $value = '1 - 2 Tanggungan';
                    } else {
                        $value = 'Tidak Ada Tanggungan';
                    }
                }

                $subCriteria = SubKriteria::whereHas('kriteria', function ($query) use ($key) {
                    $query->where('nama', $key);
                })->where('nama', $value)->first();

                $masyarakat->penilaian()->create([
                    'kriteria_id' => $subCriteria->kriteria_id,
                    'sub_kriteria_id' => $subCriteria->id,
                ]);
            }
        }
    }
}
