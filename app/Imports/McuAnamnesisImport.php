<?php

namespace App\Imports;

use App\Models\McuT;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuAnamnesisImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            McuT::create([
                'mcu_code' => $row['mcu_code'],
                'mcu_date' => '2024-11-21 22:35:35',
                'employee_id' => $row['employee_id'],
                'company_id' => $row['company_id'],
                'mcu_program_id' => $row['mcu_program_id'],
            ]);
        }
    }
}
