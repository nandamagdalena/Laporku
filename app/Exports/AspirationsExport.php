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
    protected $start_date;
    protected $end_date;

    public function __construct($aspirations, $start_date = null, $end_date = null)
    {
        $this->aspirations = $aspirations;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        return $this->aspirations->map(function ($item, $index) {
            return [
                $index + 1,
                $item->user->name ?? '-',
                optional($item->date)->format('d-m-Y'),
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
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                // jadi 5 baris header)
                $sheet->insertNewRowBefore(1, 5);

                // HEADER SEKOLAH
                $sheet->mergeCells('A1:F1');
                $sheet->setCellValue('A1', 'SMK NEGERI 4 BOJONEGORO');

                $sheet->mergeCells('A2:F2');
                $sheet->setCellValue('A2', 'Aplikasi Pengaduan Sarana Sekolah');

                $sheet->mergeCells('A3:F3');
                $sheet->setCellValue('A3', 'LAPORAN DATA PENGADUAN');

                // PERIODE OTOMATIS
                $sheet->mergeCells('A4:F4');

                if ($this->start_date && $this->end_date) {
                    $periode = 'Periode: '
                        . date('d-m-Y', strtotime($this->start_date))
                        . ' s/d '
                        . date('d-m-Y', strtotime($this->end_date));
                } else {
                    $periode = 'Semua Data';
                }

                $sheet->setCellValue('A4', $periode);

                // Style header
                $sheet->getStyle('A1:A4')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A3')->getFont()->setBold(true);
                $sheet->getStyle('A4')->getFont()->setItalic(true);

                // Style heading tabel (row 6 karena tadi tambah 5 baris)
                $sheet->getStyle('A6:F6')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '1F4E78'],
                    ],
                ]);

                $lastRow = $sheet->getHighestRow();

                // Border semua tabel
                $sheet->getStyle("A6:F{$lastRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                // Center kolom tertentu
                $sheet->getStyle("A7:A{$lastRow}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle("C7:C{$lastRow}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle("F7:F{$lastRow}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        ];
    }
}
