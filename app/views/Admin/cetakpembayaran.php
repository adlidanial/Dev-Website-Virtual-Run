<?php
    require '../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'BIL');
    $sheet->setCellValue('B1', 'SESI');
    $sheet->setCellValue('C1', 'NAMA PESERTA');
    $sheet->setCellValue('D1', 'NO. RUJUKAN PESERTA');
    $sheet->setCellValue('E1', 'NO. RUJUKAN PEMBAYARAN');
    $sheet->setCellValue('F1', 'STATUS PEMBAYARAN');
    $sheet->setCellValue('G1', 'KETERANGAN');
    $sheet->setCellValue('H1', 'KOD BIL');
    $sheet->setCellValue('I1', 'TARIKH KEMASKINI');
    
    $bil = 0;
    $numcell = 2;

    foreach($data["pembayaran"] as $row)
    {
        $sheet->setCellValue('A'.$numcell, ++$bil);
        $sheet->setCellValue('B'.$numcell, $row->SESI);
        $sheet->setCellValue('C'.$numcell, $row->NAMA);
        $sheet->setCellValue('D'.$numcell, $row->FK_ID_NO_RUJUKAN_PESERTA);
        $sheet->setCellValue('E'.$numcell, $row->NO_RUJUKAN);
        $sheet->setCellValue('F'.$numcell, $row->STATUS);
        $sheet->setCellValue('G'.$numcell, $row->KETERANGAN);
        $sheet->setCellValue('H'.$numcell, $row->KOD_BIL);
        $sheet->setCellValue('I'.$numcell, date('d-m-Y H:i', strtotime($row->TARIKH_KEMASKINI)));
        $numcell++;
    }

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="senarai-pembayaran.xlsx"');
    $writer->save('php://output');
?>