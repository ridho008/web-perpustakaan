<?php 
// menangkap id_buku di url
$id_buku = $_GET['id'];

$conn->query("DELETE FROM tb_buku WHERE id_buku = $id_buku") or die(mysqli_error($conn));
echo "<script>alert('Data Berhasil Dihapus.');window.location='?p=buku';</script>";

?>