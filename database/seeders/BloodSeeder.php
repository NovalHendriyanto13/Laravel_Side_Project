<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blood;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $params = [
            [
                'code' => 'WB0001',
                'name' => 'WB Segar',
                'blood_type' => 'Darah Lengkap',
                'blood_type_alias' => 'Whole Blood',
            ],
            [
                'code' => 'WB0002',
                'name' => 'WB Biasa',
                'blood_type' => 'Darah Lengkap',
                'blood_type_alias' => 'Whole Blood',
            ],
            [
                'code' => 'PRC001',
                'name' => 'PRC Biasa',
                'blood_type' => 'Darah Merah Pekat',
                'blood_type_alias' => 'Packed Red Cell',
            ],
            [
                'code' => 'PRC002',
                'name' => 'PRC Pediatric Leukodepieted',
                'blood_type' => 'Darah Merah Pekat',
                'blood_type_alias' => 'Packed Red Cell',
            ],
            [
                'code' => 'PRC003',
                'name' => 'PRC dengan Filter (Leukodepieted)',
                'blood_type' => 'Darah Merah Pekat',
                'blood_type_alias' => 'Packed Red Cell',
            ],
            [
                'code' => 'WE0001',
                'name' => 'Washed Erytrocyte',
                'blood_type' => 'Washed Erytrocyte',
                'blood_type_alias' => 'WE',
            ],
            [
                'code' => 'TDB001',
                'name' => 'TC Biasa',
                'blood_type' => 'Thrombocyte Concentrate',
                'blood_type_alias' => 'TC',
            ],
            [
                'code' => 'TDB002',
                'name' => 'TC Apheresis',
                'blood_type' => 'Thrombocyte Concentrate',
                'blood_type_alias' => 'TC',
            ],
            [
                'code' => 'TDB003',
                'name' => 'TC Pooled (Leukodepieted)',
                'blood_type' => 'Thrombocyte Concentrate',
                'blood_type_alias' => 'TC',
            ],
            [
                'code' => 'PD0001',
                'name' => 'Plasma Cair (Liquid Plasma)',
                'blood_type' => 'Plasma',
                'blood_type_alias' => 'Plasma',
            ],
            [
                'code' => 'PD0002',
                'name' => 'Plasma Segar Beku (FPP)',
                'blood_type' => 'Plasma',
                'blood_type_alias' => 'Plasma',
            ],
            [
                'code' => 'PD0003',
                'name' => 'Cyroprecipitate-AHF',
                'blood_type' => 'Plasma',
                'blood_type_alias' => 'Plasma',
            ],
        ];

        foreach($params as $param) {
            Blood::firstOrCreate($param);
        }
    }
}
