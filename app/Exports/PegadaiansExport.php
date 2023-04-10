<?php

namespace App\Exports;

use App\Models\Pegadaian;
// mengambil data dari database
use Maatwebsite\Excel\Concerns\FromCollection;
// mengatur nama-nama column header  di excel
use Maatwebsite\Excel\Concerns\WithHeadings;
// mengatur data yang dimunculkan tiap column di excelnya
use Maatwebsite\Excel\Concerns\WithMapping;

class PegadaiansExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Pegadaian::all();
        return Pegadaian::with('response')->orderBy('created_at', 'DESC')->get();
    }

    public function headings(): array 
    {
        return [
            'ID',
            'Nama',
            'Email',
            'age',
            'Telp',
            'NIK',
            'Item',
            'Status',
            'Location',
            'Updated At',
        ];
    }
    // mengatur data yang ditampilkan per column di excel nya
    // fungsinya seperti foreach. $item merupakan bagian as pada foreach
    public function map($item): array 
    {
        return [
            $item->id,
            $item->name,
            $item->email,
            $item->age,
            $item->phone,
            $item->nik,
            $item->item,            
            $item->response ? $item->response['type'] : '_',
            $item->response ? $item->response['location'] : '_',
            \Carbon\Carbon::parse($item->created_at)->format('j F, Y'),
        ];
    }
}
