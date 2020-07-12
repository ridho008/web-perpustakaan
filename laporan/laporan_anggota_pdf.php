<?php 
ob_start();
require_once '../config/koneksi.php';
require_once '../assets/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();

$semuaAnggota = [];
$sqlAnggota = $conn->query("SELECT * FROM tb_anggota") or die(mysqli_error($conn));
while ($pecahAnggota = $sqlAnggota->fetch_assoc()) {
	$semuaAnggota[] = $pecahAnggota;
}
// $jk = ($pecahAnggota['jk'] == 'L') ? 'Laki-Laki' : 'Perempuan';


$html = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Export to PDF Anggota</title>
</head>
<body>
<h2>Laporan Anggota</h2>
	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
      <th>No</th>
      <th>Nama</th>
      <th>Tempat Lahir</th>
      <th>Tanggal Lahir</th>
      <th>Jenis Kelamin</th>
      <th>Program Studi</th>
  	</tr>';
  	$no = 1;
  	foreach($semuaAnggota as $key => $value) {
  		$html .= '
							<tr>
								<td>'. $no++ .'</td>
								<td>'. $value["nama_anggota"] .'</td>
								<td>'. $value["tempat_lahir"] .'</td>
								<td>'. $value["tgl_lahir"] .'</td>
								<td>'. $value["jk"] .'</td>
								<td>'. $value["prodi"] .'</td>
							</tr>

  					';
  	}
$html .= '
</table>
</body>
</html>';

$html2pdf->writeHTML($html);
ob_end_clean();
$html2pdf->output();


?>
