<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Banjar;
use App\Models\Bantuan;
use App\Models\UsulanDanaBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // Pastikan menambahkan ini di bagian atas file

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class DataBantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $DataBantuans = UsulanDanaBantuan::with('banjar')->where('status', '1')->get();
        return view('admin.data_bantuan.index', compact('DataBantuans'))->with('i');
    }

    public function cetak_laporan()
    {
        $DataBantuans = UsulanDanaBantuan::with('banjar')->where('status', '1')->get();

        return view('admin.data_bantuan.cetak_laporan', compact('DataBantuans'))->with('i');
    }

    public function exportXlsx()
    {
        // Membuat instance dari Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Mengatur header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Alamat');
        $sheet->setCellValue('E1', 'Usulan');
        $sheet->setCellValue('F1', 'Tanggal Muskel');
        $sheet->setCellValue('G1', 'Lingkungan');
        $sheet->setCellValue('H1', 'Status');
        $sheet->setCellValue('I1', 'Keterangan');

        // Mengatur lebar kolom agar otomatis
        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Mengubah warna background header menjadi soft gray
        $sheet->getStyle('A1:I1')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFD3D3D3'], // Soft Gray
            ],
            'font' => [
                'bold' => true,
            ],
        ]);

        // Mengambil data dari database
        $usulanDanaBantuans = UsulanDanaBantuan::with('banjar')->where('status', '1')->get();

        // Menulis data ke dalam file Excel
        $row = 2; // Mulai menulis dari baris kedua
        $no = 1; // Penomoran mulai dari 1
        foreach ($usulanDanaBantuans as $usulan) {
            $sheet->setCellValue('A' . $row, $no++); // Menambahkan nomor urut
            $sheet->setCellValue('B' . $row, $usulan->id);
            $sheet->setCellValue('C' . $row, $usulan->nama);
            $sheet->setCellValue('D' . $row, $usulan->alamat);
            $sheet->setCellValue('E' . $row, $usulan->bantuan->nama_bantuan ?? 'N/A');
            // Periksa apakah $usulan->tgl_musreng bukan null dan merupakan instance dari Carbon
        $tglMusreng = $usulan->tgl_musreng ? Carbon::parse($usulan->tgl_musreng)->format('Y-m-d') : 'N/A';
        $sheet->setCellValue('F' . $row, $tglMusreng);
            $sheet->setCellValue('G' . $row, $usulan->banjar->nama_banjar ?? 'N/A');
            $sheet->setCellValue('H' . $row, $usulan->status_label);
            $sheet->setCellValue('I' . $row, $usulan->keterangan);
            $row++;
        }

        // Menambahkan border ke seluruh data (A1 sampai I(row terakhir))
        $sheet->getStyle('A1:I' . ($row - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'], // Hitam
                ],
            ],
        ]);

        // Membuat Writer untuk mengonversi spreadsheet menjadi file XLSX
        $writer = new Xlsx($spreadsheet);

        // Membuat StreamedResponse untuk mendownload file
        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        // Mengatur header respons dengan benar menggunakan `headers->set()`
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="usulan_dana_bantuan.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }


    
}