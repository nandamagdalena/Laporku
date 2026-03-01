<?php

namespace App\Exports;

use App\Models\Aspiration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class AspirationsExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    protected $aspirations;

    public function __construct($aspirations)
    {
        $this->aspirations = $aspirations;
    }

    public function collection()
    {
        return $this->aspirations->map(function ($item, $index) {
            return [
                $index + 1,
                $item->user->name ?? '-',
                optional($item->created_at)->format('d-m-Y'),
                $item->category->name ?? '-',
                $item->location,
                ucfirst($item->status),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Tanggal',
            'Kategori',
            'Lokasi',
            'Status',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                // Geser data ke bawah (biar ada header sekolah)
                $sheet->insertNewRowBefore(1, 4);

                // HEADER SEKOLAH
                $sheet->mergeCells('A1:F1');
                $sheet->setCellValue('A1', 'SMK NEGERI 4 BOJONEGORO');

                $sheet->mergeCells('A2:F2');
                $sheet->setCellValue('A2', 'Aplikasi Pengaduan Sarana Sekolah');

                $sheet->mergeCells('A3:F3');
                $sheet->setCellValue('A3', 'LAPORAN DATA PENGADUAN');

                $sheet->getStyle('A1:A3')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A3')->getFont()->setBold(true);

                // Style heading table (row 5)
                $sheet->getStyle('A5:F5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'], // teks putih
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '1F4E78'], // biru elegan
                    ],
                ]);

                $lastRow = $sheet->getHighestRow();

                // Border semua tabel
                $sheet->getStyle("A5:F{$lastRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                // Center kolom tertentu
                $sheet->getStyle("A6:A{$lastRow}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle("C6:C{$lastRow}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle("F6:F{$lastRow}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        ];
    }
}
