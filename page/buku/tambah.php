<?php 
if(isset($_POST['tambah'])) {
	$judul = htmlspecialchars($_POST['judul_buku']);
	$pengarang = htmlspecialchars($_POST['pengarang_buku']);
	$penerbit = htmlspecialchars($_POST['penerbit_buku']);
	$tahun_terbit = htmlspecialchars($_POST['tahun_terbit']);
	$isbn = htmlspecialchars($_POST['isbn']);
	$jumlah = htmlspecialchars($_POST['jumlah_buku']);
	$lokasi = htmlspecialchars($_POST['lokasi']);
	$tgl_input = htmlspecialchars($_POST['tgl_input']);

    if(empty($judul && $pengarang && $penerbit && $tahun_terbit && $isbn && $jumlah && $lokasi && $tgl_input)) {
        echo "<script>alert('Pastikan anda sudah mengisi semua formulir.');window.location='?p=buku';</script>";
    }

	$sql = $conn->query("INSERT INTO tb_buku VALUES (null, '$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$isbn', '$jumlah', '$lokasi', '$tgl_input')") or die(mysqli_error($conn));
	if($sql) {
		echo "<script>alert('Data Berhasil Ditambahkan.');window.location='?p=buku';</script>";
	} else {
		echo "<script>alert('Data Gagal Ditambahkan.')</script>";
	}
}

?>

<h1 class="mt-4">Tambah Data Buku</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">tambah data buku</li>
</ol>
<div class="card-header mb-5">
	
	<form action="" method="post">
    <div class="form-group">
        <label class="small mb-1" for="judul_buku">Judul Buku</label>
        <input class="form-control" id="judul_buku" name="judul_buku" type="text" placeholder="Masukan judul buku"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="pengarang_buku">Pengarang</label>
        <input class="form-control" id="pengarang_buku" name="pengarang_buku" type="text" placeholder="Masukan pengarang buku"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="penerbit_buku">Penerbit</label>
        <input class="form-control" id="penerbit_buku" name="penerbit_buku" type="text" placeholder="Masukan penerbit buku"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="tahun_terbit">Tahun Terbit</label>
        <select name="tahun_terbit" id="tahun_terbit" class="form-control">
        	<option value="">-- Pilih Tahun --</option>
        	<?php 
        	// menampilkan tahun terbit dari tahun 1991- hingga tahun sekarang
        	$tahun = date('Y');

        	for ($i = $tahun - 29; $i <= $tahun ; $i++) { ?>
        		<option value="<?= $i ?>"><?= $i ?></option>
        	<?php
        	}
        	?>
        </select>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="isbn">ISBN</label>
        <input class="form-control" id="isbn" name="isbn" type="text" placeholder="Masukan isbn buku"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="jumlah_buku">Jumlah Buku</label>
        <input class="form-control" id="jumlah_buku" name="jumlah_buku" type="number" placeholder="Masukan jumlah buku"/>
    </div>
    <div class="form-group">
    	<label for="lokasi">Lokasi</label>
    	<select name="lokasi" id="lokasi" class="form-control">
    		<option value="">-- Pilih Rak --</option>
    		<option value="Rak 1">Rak 1</option>
    		<option value="Rak 3">Rak 2</option>
    		<option value="Rak 3">Rak 3</option>
    	</select>
    </div>
    <div class="form-group">
    	<label for="tgl_input">Tanggal Input</label>
    	<input type="date" name="tgl_input" id="tgl_input" class="form-control">
    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
    </div>
	</form>
</div>