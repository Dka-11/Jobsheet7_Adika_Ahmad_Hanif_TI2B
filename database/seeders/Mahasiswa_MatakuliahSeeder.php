<?php

namespace Database\Seeders;

use App\Models\Mahasiswa_Matakuliah;
use Illuminate\Database\Seeder;

class Mahasiswa_MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = [
            [
                'mahasiswa_id' => 12,
                'matakuliah_id' => 1,
                'nilai' => 'A',
            ],
            [
                'mahasiswa_id' => 12,
                'matakuliah_id' => 2,
                'nilai' => 'B+',
            ],
            [
                'mahasiswa_id' => 12,
                'matakuliah_id' => 3,
                'nilai' => 'A',
            ],
            [
                'mahasiswa_id' => 12,
                'matakuliah_id' => 4,
                'nilai' => 'A',
            ],
        ];

        Mahasiswa_Matakuliah::insert($value);
    }
}
