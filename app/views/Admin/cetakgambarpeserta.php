<?php
    require '../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    $sheet->setCellValue('A1', 'BIL');
    $sheet->setCellValue('B1', 'SESI');
    $sheet->setCellValue('C1', 'NAMA PESERTA');
    $sheet->setCellValue('D1', 'NO KAD PENGENALAN');
    $sheet->setCellValue('E1', 'EMEL');
    $sheet->setCellValue('F1', 'NO. TELEFON');
    $sheet->setCellValue('G1', 'NO. EBIB');
    $sheet->setCellValue('H1', 'NAMA FAIL GAMBAR LARIAN');
    $sheet->setCellValue('I1', 'TARIKH KEMASKINI');
    $sheet->setCellValue('J1', 'STATUS');

    $bil = 0;
    $numcell = 2;

    foreach($data["gambarpeserta"] as $row)
    {
        $sheet->setCellValue('A'.$numcell, ++$bil);
        $sheet->setCellValue('B'.$numcell, $row->FK_ID_SESI);
        $sheet->setCellValue('C'.$numcell, $row->NAMA);
        $sheet->setCellValue('D'.$numcell, $row->NO_KAD_PENGENALAN);
        $sheet->setCellValue('E'.$numcell, $row->EMEL);
        $sheet->setCellValue('F'.$numcell, $row->NO_TELEFON);
        $sheet->setCellValue('G'.$numcell, $row->NO_EBIB);
        $sheet->setCellValue('H'.$numcell, $row->URL_GAMBAR);
        $sheet->setCellValue('I'.$numcell, (isset($row->TARIKH_KEMASKINI)) ? date('d-m-Y H:i', strtotime($row->TARIKH_KEMASKINI)) : "");
        $sheet->setCellValue('J'.$numcell, $row->STATUS);
        $numcell++;
    }

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="senarai-gambar-peserta.xlsx"');
    $writer->save('php://output');
?>