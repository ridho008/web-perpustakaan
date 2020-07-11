<?php 
if(isset($_POST['tambah'])) {
	$nim = htmlspecialchars($_POST['nim']);
	$nama = htmlspecialchars($_POST['nama_anggota']);
	$tempat_lahir = htmlspecialchars($_POST['tempat_lahir']);
	$tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
	$jk = htmlspecialchars($_POST['jk']);
	$prodi = htmlspecialchars($_POST['prodi']);

    if(empty($nim && $nama && $tempat_lahir && $tgl_lahir && $jk && $prodi)) {
        echo "<script>alert('Pastikan anda sudah mengisi semua formulir.');window.location='?p=buku';</script>";
    }

	$sql = $conn->query("INSERT INTO tb_anggota VALUES (null, '$nim', '$nama', '$tempat_lahir', '$tgl_lahir', '$jk', '$prodi')") or die(mysqli_error($conn));
	if($sql) {
		echo "<script>alert('Data Berhasil Ditambahkan.');window.location='?p=anggota';</script>";
	} else {
		echo "<script>alert('Data Gagal Ditambahkan.')</script>";
	}
}

?>

<h1 class="mt-4">Tambah Data Anggota</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">tambah data anggota</li>
</ol>
<div class="card-header mb-5">
	
	<form action="" method="post">
    <div class="form-group">
        <label class="small mb-1" for="nim">NIM</label>
        <input class="form-control" id="nim" name="nim" type="number" placeholder="Masukan judul buku"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="nama_anggota">Nama</label>
        <input class="form-control" id="nama_anggota" name="nama_anggota" type="text" placeholder="Masukan pengarang buku"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="tempat_lahir">Tempat Lahir</label>
        <input class="form-control" id="tempat_lahir" name="tempat_lahir" type="text" placeholder="Masukan penerbit buku"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="tgl_lahir">Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control">
    </div>
    <div class="form-group">
        <label class="small mb-1" for="jk">Jenis Kelamin</label>
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio1" name="jk" value="L" class="custom-control-input">
          <label class="custom-control-label" for="customRadio1">Laki-Laki</label>
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio2" name="jk" class="custom-control-input" value="P">
          <label class="custom-control-label" for="customRadio2">Perempuan</label>
        </div>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="jumlah_buku">Prodi</label>
        <select name="prodi" id="prodi" class="form-control">
            <option value="">-- Pilih Prodi --</option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Teknik Management">Teknik Management</option>
            <option value="Sistem Operasi">Sistem Operasi</option>
        </select>
    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
    </div>
	</form>
</div>