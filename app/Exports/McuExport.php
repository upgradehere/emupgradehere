<?php

namespace App\Exports;

use App\Models\McuEmployeeV;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class McuExport implements FromCollection, WithHeadings, WithColumnFormatting, ShouldAutoSize
{

    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $model = new McuEmployeeV();
        $query = $model->select(
            'mcu_employee_v.mcu_id',
            'mcu_employee_v.mcu_code',
            'mcu_employee_v.nik',
            'mcu_employee_v.employee_name'
        );
        $query = $query->where('mcu_program_id', $this->filters['mcu_program_id'])->where('company_id', $this->filters['company_id'])->orderBy('mcu_id', 'ASC');
        $records = $query->get();
        return $records->map(function ($item, $index) {
            return [
                'no' => $index + 1,
                'mcu_code' => $item->mcu_code,
                'nik' => '="' . $item->nik . '"',
                'employee_name' => $item->employee_name,
            ];
        });
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ['no', 'mcu_code', 'nik', 'employee_name'];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT
        ];
    }
}
