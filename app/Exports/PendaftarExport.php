<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Pendaftar;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendaftarExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $search;

    // Konstruktor untuk menerima parameter pencarian
    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        // Menyaring data berdasarkan pencarian jika ada
        $query = Pendaftar::query();

        if ($this->search) {
            // Menyaring berdasarkan job_name jika ada pencarian
            $query->whereHas('job', function ($query) {
                $query->where('job_name', 'like', '%' . $this->search . '%');
            });
        }

        return $query->get();
    }

    public function headings(): array
    {
        // Menentukan kolom yang akan diekspor
        return [
            'ID',
            'Nama',
            'Email',
            'Pekerjaan',
            'Status',
            'Tgl Tes',
            'Tgl Interview',
            'Tgl MCU',
            'Keterangan',
            'Tanggal Daftar',
        ];
    }

    public function map($pendaftar): array
    {
        // Memetakan setiap data untuk diekspor ke file Excel
        return [
            $pendaftar->id,
            $pendaftar->name,
            $pendaftar->email,
            $pendaftar->job ? $pendaftar->job->job_name : 'N/A', // Menampilkan pekerjaan jika ada
            $pendaftar->status,
            Carbon::parse($pendaftar->tanggal_tes)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm'),
            Carbon::parse($pendaftar->tanggal_interview)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm'),
            Carbon::parse($pendaftar->tanggal_mcu)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm'),
            $pendaftar->keterangan,
            Carbon::parse($pendaftar->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm'),
        ];
    }
    public function styles(Worksheet $sheet)
    {
        // Memberikan gaya pada header (Baris pertama)
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:J1')->getFill()->getStartColor()->setRGB('FFFF00'); // Mengubah latar belakang header menjadi kuning

        // Menata kolom secara otomatis (agar teks tidak terpotong)
        $sheet->getStyle('A:J')->getAlignment()->setWrapText(true); // Membungkus teks jika terlalu panjang
    }

    public function columnWidths(): array
    {
        // Menentukan lebar kolom agar lebih rapi
        return [
            'A' => 10, // Kolom ID
            'B' => 20, // Kolom Nama
            'C' => 25, // Kolom Pekerjaan
            'D' => 25, // Kolom Email
            'E' => 10,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 30, // Kolom Tanggal Daftar
        ];
    }

}