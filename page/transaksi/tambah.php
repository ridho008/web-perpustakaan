<?php 
// menampilkan judul buku di TB_buku di bagian option pilih buku
$tampilNamaBuku = $conn->query("SELECT * FROM tb_buku") or die(mysqli_error($conn));

// menampilkan nama anggota & nim di TB_anggota di bagian option pilih anggota
$tampilNamaAnggota = $conn->query("SELECT * FROM tb_anggota") or die(mysqli_error($conn));

// $sql = $conn->query("SELECT * FROM tb_buku INNER JOIN tb_anggota ON tb_buku.id_buku = tb_anggota.id_anggota") or die(mysqli_error($conn));

$tgl_pinjam = date('Y-m-d');
$tujuh_hari = mktime(0,0,0, date('n'), date('j') + 7, date('Y'));
$kembali = date('Y-m-d', $tujuh_hari);

if(isset($_POST['tambah'])) {
    
    $tgl_pinjam = htmlspecialchars($_POST['tgl_pinjam']);
    $tgl_kembali = htmlspecialchars($_POST['tgl_kembali']);
    
    $nama_buku = htmlspecialchars($_POST['nama_buku']);
    $pecahB = explode('.', $nama_buku);
    $id = $pecahB[0];
    $judul = $pecahB[1];

    $nama_anggota = htmlspecialchars($_POST['nama_anggota']);
    $pecahN = explode('.', $nama_anggota);
    $nim = $pecahN[0];
    $nama = $pecahN[1];

    $sql = $conn->query("SELECT * FROM tb_buku WHERE judul_buku = '$judul'") or die(mysqli_error($conn));
    while($data = $sql->fetch_assoc()) {
        $sisa = $data['jumlah_buku'];

        if($sisa == 0) {
            echo "<script>alert('Stok Buku Habis, Transaksi, tidak dapat dilakukan, silahkan tambahkan stok buku dulu.');window.location='?p=transaksi&aksi=tambah';</script>";
        }
    }
}


?>

<h1 class="mt-4">Tambah Data Transaksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">tambah data transaksi</li>
</ol>
<div class="card-header mb-5">
	
	<form action="" method="post">
    
    <div class="form-group">
        <label class="small mb-1" for="nama_buku">Buku</label>
        <select name="nama_buku" id="nama_buku" class="form-control">
            <option value="">-- Pilih Buku --</option>
            <?php 
            while ($pecahBuku = $tampilNamaBuku->fetch_assoc()) { ?>
            <option value="<?= $pecahBuku['id_buku'].$pecahBuku['judul_buku']; ?>"><?= $pecahBuku['judul_buku']; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="nama_anggota">Nama</label>
        <select name="nama_anggota" id="nama_anggota" class="form-control">
            <option value="">-- Pilih Anggota --</option>
            <?php 
            while ($pecahAnggota = $tampilNamaAnggota->fetch_assoc()) { ?>
            <option value="<?= $pecahAnggota['nim'].$pecahAnggota['nama_anggota']; ?>"><?= $pecahAnggota['nim'] . " " . $pecahAnggota['nama_anggota']; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tgl_pinjam">Tanggal Pinjam</label>
        <input type="text" name="tgl_pinjam" id="tgl_pinjam" class="form-control" value="<?= $tgl_pinjam ?>">
    </div>
    <div class="form-group">
        <label for="tgl_kembali">Tanggal Kembali</label>
        <input type="text" name="tgl_kembali" id="tgl_kembali" class="form-control" value="<?= $kembali ?>">
    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
    </div>
	</form>
</div>