<?php

namespace App\Exports;

use App\Models\CalonSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    protected $exclude = [
        'akta_kelahiran',
        'kartu_keluarga',
        'foto_kip',
        'status_pendaftaran',
    ];

    public function collection()
    {
        $model = new CalonSiswa();
        $fields = array_diff($model->getFillable(), $this->exclude);

        return CalonSiswa::select($fields)->get();
    }

    public function headings(): array
    {
        $model = new CalonSiswa();
        $fields = array_diff($model->getFillable(), $this->exclude);

        return array_map(function ($field) {
            $custom = [
                'no_hp' => 'No HP',
                'no_kip' => 'No KIP',
                'akta_kelahiran' => 'Akta Kelahiran',
                'kartu_keluarga' => 'Kartu Keluarga',
                'foto_kip' => 'Foto KIP',
            ];

            return $custom[$field] ?? ucwords(str_replace('_', ' ', $field));
        }, $fields);
    }
}
