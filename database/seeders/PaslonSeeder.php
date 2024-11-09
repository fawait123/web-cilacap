<?php

namespace Database\Seeders;

use App\Models\Paslon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaslonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paslon::truncate();
        Paslon::insert([
            [
                'name' => 'SETYO BUDI WIBOWO - FARUR ROZI',
                'number' => 1,
                'picture' => 'paslon/paslon-01.jpg'
            ],
            [
                'name' => 'DR. H. IMAM TOBRONI - IR. MOCHAMAD SONHAJI IMRON',
                'number' => 2,
                'picture' => 'paslon/paslon-02.jpg'
            ],
            [
                'name' => 'DR. SYAMSUL AULIYA RACHMAN, S.STP., M.SI - AMMY AMALIA FATMA SURYA, SH., M.KN',
                'number' => 3,
                'picture' => 'paslon/paslon-03.jpg'
            ],
            [
                'name' => 'AWALUDDIN MUURI, A.P., M.M - VICKY VERANITA YUDHASOKA, S.IP',
                'number' => 4,
                'picture' => 'paslon/paslon-04.jpg'
            ]
        ]);
    }
}
