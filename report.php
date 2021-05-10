<!-- Menambahkan skrip php -->
<?php
// Menambahkan file eskternal ke dalam file report.php
require 'vendor/autoload.php';
// Menggunakan namespace dari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Membuat objek
$spreadsheet = new Spreadsheet();
// Membuat variabel untuk activesheet di file excel
$sheet = $spreadsheet->getActiveSheet();
// Mengisi cell
$sheet->setCellValue('A1', 'Hello World !');

// Merender file
$writer = new Xlsx($spreadsheet);
// Melakukan expor dengan nama file yang sesuai
$writer->save('hello world.xlsx');
?>