<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LabAnalyte;

class LabAnalytesSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            // --- CBC Core ---
            [
                'code' => 'WBC',
                'display_name' => 'WBC',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['WBC','LEUKOCYTES','LEUCOCYTES'],
                'instrument_synonyms' => ['TEK8520'=>['WBC'], 'TC3060'=>['WBC']],
            ],
            [
                'code' => 'RBC',
                'display_name' => 'RBC',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['RBC','ERYTHROCYTES'],
                'instrument_synonyms' => ['TEK8520'=>['RBC'], 'TC3060'=>['RBC']],
            ],
            [
                'code' => 'HGB',
                'display_name' => 'Hemoglobin',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['HGB','HB'],
                'instrument_synonyms' => ['TEK8520'=>['HGB'], 'TC3060'=>['HGB']],
            ],
            [
                'code' => 'HCT',
                'display_name' => 'Hematocrit',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['HCT'],
                'instrument_synonyms' => ['TEK8520'=>['HCT'], 'TC3060'=>['HCT']],
            ],
            [
                'code' => 'MCV',
                'display_name' => 'MCV',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['MCV'],
                'instrument_synonyms' => ['TEK8520'=>['MCV'], 'TC3060'=>['MCV']],
            ],
            [
                'code' => 'MCH',
                'display_name' => 'MCH',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['MCH'],
                'instrument_synonyms' => ['TEK8520'=>['MCH'], 'TC3060'=>['MCH']],
            ],
            [
                'code' => 'MCHC',
                'display_name' => 'MCHC',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['MCHC'],
                'instrument_synonyms' => ['TEK8520'=>['MCHC'], 'TC3060'=>['MCHC']],
            ],
            [
                'code' => 'RDW_CV',
                'display_name' => 'RDW-CV',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['RDW_CV','RDW-CV','RDW CV'],
                'instrument_synonyms' => ['TEK8520'=>['RDW_CV','RDW-CV'], 'TC3060'=>['RDW_CV','RDW-CV']],
            ],
            [
                'code' => 'RDW_SD',
                'display_name' => 'RDW-SD',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['RDW_SD','RDW-SD','RDW SD'],
                'instrument_synonyms' => ['TEK8520'=>['RDW_SD','RDW-SD'], 'TC3060'=>['RDW_SD','RDW-SD']],
            ],
            [
                'code' => 'PLT',
                'display_name' => 'Platelets',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['PLT','PLATELET','PLATELETS'],
                'instrument_synonyms' => ['TEK8520'=>['PLT'], 'TC3060'=>['PLT']],
            ],
            [
                'code' => 'MPV',
                'display_name' => 'MPV',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['MPV'],
                'instrument_synonyms' => ['TEK8520'=>['MPV'], 'TC3060'=>['MPV']],
            ],
            [
                'code' => 'PCT',
                'display_name' => 'PCT',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['PCT'],
                'instrument_synonyms' => ['TEK8520'=>['PCT'], 'TC3060'=>['PCT']],
            ],
            [
                'code' => 'PDW',
                'display_name' => 'PDW',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['PDW'],
                'instrument_synonyms' => ['TEK8520'=>['PDW'], 'TC3060'=>['PDW']],
            ],
            [
                'code' => 'P_LCR',
                'display_name' => 'P-LCR',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['P_LCR','P-LCR','PLCR'],
                'instrument_synonyms' => ['TEK8520'=>['P_LCR','P-LCR'], 'TC3060'=>['P_LCR','P-LCR']],
            ],
            [
                'code' => 'P_LCC',
                'display_name' => 'P-LCC',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['P_LCC','P-LCC','PLCC'],
                'instrument_synonyms' => ['TEK8520'=>['P_LCC','P-LCC'], 'TC3060'=>['P_LCC','P-LCC']],
            ],

            // --- 3-part diff (names as seen in your JSONs) ---
            [
                'code' => 'GR_PERCENT',
                'display_name' => 'Granulocyte %',
                'default_unit' => '%',
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['GR%','NEUT%','GRAN%'],
                'instrument_synonyms' => ['TEK8520'=>['GR%'], 'TC3060'=>['GR%']],
            ],
            [
                'code' => 'GR_ABS',
                'display_name' => 'Granulocyte #',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['GR#','NEUT#','GRAN#'],
                'instrument_synonyms' => ['TEK8520'=>['GR#'], 'TC3060'=>['GR#']],
            ],
            [
                'code' => 'LYM_PERCENT',
                'display_name' => 'Lymphocyte %',
                'default_unit' => '%',
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['LYM%','LYMPH%'],
                'instrument_synonyms' => ['TEK8520'=>['Lym%','LYM%'], 'TC3060'=>['Lym%','LYM%']],
            ],
            [
                'code' => 'LYM_ABS',
                'display_name' => 'Lymphocyte #',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['LYM#','LYMPH#','LYM#ABS'],
                'instrument_synonyms' => ['TEK8520'=>['Lym#','LYM#'], 'TC3060'=>['Lym#','LYM#']],
            ],
            [
                'code' => 'MID_PERCENT',
                'display_name' => 'Mid %',
                'default_unit' => '%',
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['MID%'],
                'instrument_synonyms' => ['TEK8520'=>['Mid%','MID%'], 'TC3060'=>['Mid%','MID%']],
            ],
            [
                'code' => 'MID_ABS',
                'display_name' => 'Mid #',
                'default_unit' => null,
                'ref_lo' => null, 'ref_hi' => null,
                'synonyms' => ['MID#'],
                'instrument_synonyms' => ['TEK8520'=>['Mid#','MID#'], 'TC3060'=>['Mid#','MID#']],
            ],
        ];

        foreach ($rows as $r) {
            LabAnalyte::updateOrCreate(
                ['code' => $r['code']],
                [
                    'display_name' => $r['display_name'],
                    'default_unit' => $r['default_unit'],
                    'ref_lo' => $r['ref_lo'],
                    'ref_hi' => $r['ref_hi'],
                    'synonyms' => $r['synonyms'],
                    'instrument_synonyms' => $r['instrument_synonyms'],
                ]
            );
        }
    }
}
