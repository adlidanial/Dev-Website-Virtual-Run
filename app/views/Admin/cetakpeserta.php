<?php
    require '../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    $sheet->setCellValue('A1', 'BIL');
    $sheet->setCellValue('B1', 'SESI');
    $sheet->setCellValue('C1', 'NAMA AKTIVITI');
    $sheet->setCellValue('D1', 'NAMA PESERTA');
    $sheet->setCellValue('E1', 'NO KAD PENGENALAN');
    $sheet->setCellValue('F1', 'EMEL');
    $sheet->setCellValue('G1', 'NO. TELEFON');
    $sheet->setCellValue('H1', 'ALAMAT PERTAMA');
    $sheet->setCellValue('I1', 'ALAMAT KEDUA');
    $sheet->setCellValue('J1', 'ALAMAT KETIGA');
    $sheet->setCellValue('K1', 'POSKOD');
    $sheet->setCellValue('L1', 'BANDAR');
    $sheet->setCellValue('M1', 'NEGERI');
    $sheet->setCellValue('N1', 'NEGARA');
    $sheet->setCellValue('O1', 'NO. EBIB');
    $sheet->setCellValue('P1', 'SAIZ BAJU');
    $sheet->setCellValue('Q1', 'AMAUN');
    $sheet->setCellValue('R1', 'NO. RUJUKAN PESERTA');
    $sheet->setCellValue('S1', 'NO. RUJUKAN PEMBAYARAN');
    $sheet->setCellValue('T1', 'STATUS PEMBAYARAN');
    $sheet->setCellValue('U1', 'TARIKH KEMASKINI PEMBAYARAN');

    $bil = 0;
    $numcell = 2;

    foreach($data["peserta"] as $row)
    {
        $sheet->setCellValue('A'.$numcell, ++$bil);
        $sheet->setCellValue('B'.$numcell, $row->FK_ID_SESI);
        $sheet->setCellValue('C'.$numcell, $row->NAMA_AKTIVITI);
        $sheet->setCellValue('D'.$numcell, $row->NAMA);
        $sheet->setCellValue('E'.$numcell, $row->NO_KAD_PENGENALAN);
        $sheet->setCellValue('F'.$numcell, $row->EMEL);
        $sheet->setCellValue('G'.$numcell, $row->NO_TELEFON);
        $sheet->setCellValue('H'.$numcell, $row->ALAMAT_PERTAMA);
        $sheet->setCellValue('I'.$numcell, $row->ALAMAT_KEDUA);
        $sheet->setCellValue('J'.$numcell, $row->ALAMAT_KETIGA);
        $sheet->setCellValue('K'.$numcell, $row->POSKOD);
        $sheet->setCellValue('L'.$numcell, $row->BANDAR);
        $sheet->setCellValue('M'.$numcell, ucfirst(strtolower($row->NEGERI)));
        $sheet->setCellValue('N'.$numcell, $row->NEGARA);
        $sheet->setCellValue('O'.$numcell, $row->NO_EBIB);
        $sheet->setCellValue('P'.$numcell, $row->SAIZ_BAJU);
        $sheet->setCellValue('Q'.$numcell, $row->AMAUN);
        $sheet->setCellValue('R'.$numcell, $row->NO_RUJUKAN_PESERTA);
        $sheet->setCellValue('S'.$numcell, $row->NO_RUJUKAN);
        $sheet->setCellValue('T'.$numcell, $row->STATUS);
        $sheet->setCellValue('U'.$numcell, date('d-m-Y H:i', strtotime($row->TARIKH_KEMASKINI)));
        $numcell++;
    }

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="senarai-peserta.xlsx"');
    $writer->save('php://output');
?>