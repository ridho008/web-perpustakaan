<?php 
$id_transaksi = $_GET['id'];
$id_judul_buku = $_GET['judul'];

$conn->query("UPDATE tb_transaksi SET status = 'kembali' WHERE id_transaksi = $id_transaksi") or die(mysqli_error($conn));

$conn->query("UPDATE tb_buku SET jumlah_buku = (jumlah_buku+1) WHERE judul_buku = '$id_judul_buku'") or die(mysqli_error($conn));

	echo "<script>alert('Proses, kembalian buku berhasil.');window.location='?p=transaksi';</script>";

?>