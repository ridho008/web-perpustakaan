<?php 
require_once 'koneksi.php';

function upload() {
	$namaFoto = $_FILES['foto']['name'];
	$ukuranFoto = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmpFoto = $_FILES['foto']['tmp_name'];

	if($error === 4) {
		echo "<script>alert('pilih gambar terlebih dahulu.');</script>";
		return false;
	}

	$fotoValid = ['jpg','jpeg','png'];
	$ektensiFoto = explode('.', $namaFoto);
	$ektensiFoto = strtolower(end($ektensiFoto));

	if(!in_array($ektensiFoto, $fotoValid)) {
		echo "<script>alert('yang anda upload bukan gambar.');</script>";
		return false;
	}

	// cek ukuran
	if($ukuranFoto > 1000000) {
		echo "<script>alert('ukuran gambar terlalu besar.');</script>";
		return false;
	}

	$fileNameBaru = uniqid();
	$fileNameBaru .= '.';
	$fileNameBaru .= $ektensiFoto;

	move_uploaded_file($tmpFoto, '../img/' . $fileNameBaru);
	return $fileNameBaru;
}

function register($data) {
	global $conn;
	$nama = htmlspecialchars($data['nama']);
	$username = $conn->real_escape_string($_POST['username']);
	$password = $conn->real_escape_string($_POST['password']);
	$password2 = $conn->real_escape_string($_POST['password2']);

	// jika username sudah terdaftar
	if(query("SELECT * FROM user WHERE username = '$username'")) {
		echo "<script>alert('Username sudah terdaftar!');window.location='register.php';</script>";
		return false;
	}

	if($password != $password2) {
		echo "<script>alert('konfirmasi password salah.');</script>";
		return false;
	}

	if(strlen($username) < 6 ) {
		echo "<script>alert('Password terlalu pendek, maksimal 6 digit');window.location='register.php';</script>";
		return false;
	}

	// cek gambar
	$foto = upload();
	if(!$foto) {
		return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	$conn->query("INSERT INTO tb_user VALUES (null, '$username', '$password', '$nama', '$foto')") or die(mysqli_error($conn));
	return $conn->affected_rows;
}

