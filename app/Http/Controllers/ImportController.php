<?php

namespace App\Http\Controllers;

use App\Models\Pollstation;
use App\Models\Regionals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportController extends Controller
{
    public function regionals()
    {
        $regionals = SimpleExcelReader::create(public_path('regionals.xlsx'))->getRows();
        $regionals->each(function ($row) {
            $this->storeRegionals(rows: $row);
        });
    }

    private function storeRegionals(array $rows)
    {
        DB::beginTransaction();
        try {
            $province = Regionals::updateOrCreate(
                [
                    'name' => $rows['Provinsi'],
                    'type' => 'province'
                ],
                [
                    'name' => $rows['Provinsi'],
                    'type' => 'province'
                ]
            );

            $district = Regionals::updateOrCreate(
                [
                    'name' => $rows['Kabkota'],
                    'type' => 'district',
                    'parent_id' => $province->id
                ],
                [
                    'name' => $rows['Kabkota'],
                    'type' => 'district',
                    'parent_id' => $province->id
                ]
            );

            $subDistrict = Regionals::updateOrCreate(
                [
                    'name' => $rows['Kecamatan'],
                    'type' => 'subdistrict',
                    'parent_id' => $district->id
                ],
                [
                    'name' => $rows['Kecamatan'],
                    'type' => 'subdistrict',
                    'parent_id' => $district->id
                ]
            );

            $village = Regionals::updateOrCreate(
                [
                    'name' => $rows['Kelurahan'],
                    'type' => 'village',
                    'parent_id' => $subDistrict->id
                ],
                [
                    'name' => $rows['Kelurahan'],
                    'type' => 'village',
                    'parent_id' => $subDistrict->id
                ]
            );

            Pollstation::updateOrCreate(
                [
                    'provinceID' => $province->id,
                    'districtID' => $district->id,
                    'subdistrictID' => $subDistrict->id,
                    'villageID' => $village->id,
                    'number' => $rows['TPS']
                ]
            );

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
