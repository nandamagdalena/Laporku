<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class UsersExport implements FromCollection, WithHeadings, WithEvents, WithStyles
{
    public function collection()
    {
        $users = User::where('role', 'user')
            ->select('name', 'nis', 'email', 'phone_number')
            ->get();

        return $users->map(function ($user, $index) {
            return [
                $index + 1,
                $user->name,
                $user->nis,
                $user->email,
                $user->phone_number,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'NIS',
            'Email',
            'No. Telepon',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                // Insert Row untuk Header
                $sheet->insertNewRowBefore(1, 4);

                // Header Sekolah
                $sheet->mergeCells('A1:E1');
                $sheet->setCellValue('A1', 'SMK NEGERI 4 BOJONEGORO');

                $sheet->mergeCells('A2:E2');
                $sheet->setCellValue('A2', 'Aplikasi Pengaduan Sarana dan Prasarana Sekolah');

                $sheet->mergeCells('A3:E3');
                $sheet->setCellValue('A3', 'LAPORAN DATA PENGGUNA');

                // Style Header
                $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A2')->getFont()->setSize(12);
                $sheet->getStyle('A3')->getFont()->setBold(true);

                // Heading Table (baris ke 5)
                $sheet->getStyle('A5:E5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '1F4E79'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Border seluruh table
                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle("A5:E{$lastRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                // Auto width
                foreach (range('A','E') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                // Kolom No (A) → CENTER
                $sheet->getStyle("A6:A{$lastRow}")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // Kolom Nama sampai No Telpon → LEFT
                $sheet->getStyle("B6:E{$lastRow}")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

                $sheet->getStyle('A5:E5')->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            }
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [];
    }
}
