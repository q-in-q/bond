<?php
require '../config/connection.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


$tgl = $_POST['tanggalcetak'];
$ex = explode("-", $tgl);
$mulai = "$ex[0]-$ex[1]-$ex[2]";
$selesai = "$ex[3]-$ex[4]-$ex[5]";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama Queue');
$sheet->setCellValue('C1', 'Tanggal Mulai');
$sheet->setCellValue('D1', 'Tanggal Selesai');
$sheet->setCellValue('E1', 'Bandwidth Awal');
$sheet->setCellValue('F1', 'Bandwidth Up');

$sql = "select * from tb_simplequeue where tanggal_selesai between '$mulai' and '$selesai'";
if($result = $conn->query($sql)){
    $n = 1;
    while($row = $result->fetch_assoc()){
        $rowNum = $n + 1;
        $sheet->setCellValue('A'.$rowNum, $n);
        $sheet->setCellValue('B'.$rowNum, $row['nama']);
        $sheet->setCellValue('C'.$rowNum, $row['tanggal_mulai']);
        $sheet->setCellValue('D'.$rowNum, $row['tanggal_selesai']);
        $sheet->setCellValue('E'.$rowNum, $row['bandwidth_awal']);
        $sheet->setCellValue('F'.$rowNum, $row['bandwidth_up']);
        $n++;
    }
}


$filename = 'Laporan-'.time().'.xlsx';
// Redirect output to a client's web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
 
// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

?>