<!-- Menambahkan skrip php -->
<?php
// Menambahkan file eskternal
include('koneksi.php');
require 'vendor/autoload.php';
// Menggunakan namespace dari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Membuat objek
$spreadsheet = new Spreadsheet();
// Membuat variabel untuk activesheet di file excel
$sheet = $spreadsheet->getActiveSheet();
// Mengisi cell
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Kelas');
$sheet->setCellValue('D1', 'Alamat');
// Menyimpan perintah/query
$query = mysqli_query($koneksi,"SELECT*FROM tb_siswa");
// Menyinmpan nilai ke dalam variabel
$i = 2;
$no = 1;
// Membuat loop untuk menata nilai
while ($row = mysqli_fetch_array($query)) {
	$sheet->setCellValue('A'.$i, $no++);
	$sheet->setCellValue('B'.$i, $row['nama']);
	$sheet->setCellValue('C'.$i, $row['kelas']);
	$sheet->setCellValue('D'.$i, $row['alamat']);
	$i++;
}
// Membuat border
$styleArray = [
	'borders' => [
		'allBorders' => [
			'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],],];
// Mengurangi nilai dalam variabel
$i = $i - 1;
// Mengaplikasikan border ke dalam excel
$sheet->getStyle('A1:D'.$i)->applyFromArray($styleArray);

// Merender file
$writer = new Xlsx($spreadsheet);
// Melakukan expor dengan nama file yang sesuai
$writer->save('Report Data Siswa.xlsx');
?>