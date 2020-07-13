<?php 
// menampilkan judul buku di TB_buku di bagian option pilih buku
$tampilNamaBuku = $conn->query("SELECT * FROM tb_buku ORDER BY id_buku") or die(mysqli_error($conn));

// menampilkan nama anggota & nim di TB_anggota di bagian option pilih anggota
$tampilNamaAnggota = $conn->query("SELECT * FROM tb_anggota ORDER BY nim") or die(mysqli_error($conn));

// $sql = $conn->query("SELECT * FROM tb_buku INNER JOIN tb_anggota ON tb_buku.id_buku = tb_anggota.id_anggota") or die(mysqli_error($conn));

$tgl_pinjam = date('d-m-Y');
$tujuh_hari = mktime(0,0,0, date('n'), date('j') + 7, date('Y'));
$kembali = date('d-m-Y', $tujuh_hari);

if(isset($_POST['tambah'])) {
    
    $tgl_pinjam = htmlspecialchars($_POST['tgl_pinjam']);
    $tgl_kembali = htmlspecialchars($_POST['tgl_kembali']);
    
    // $nama_buku = $_POST['buku'];
    // $pecahB = explode(".", $nama_buku);
    // $judul = $pecahB[0];
    $nama_buku = $_POST['buku'];
    $pecahB = explode(".", $nama_buku);
    $id = $pecahB[0];
    $judul = $pecahB[1];
    // var_dump($id); 
    // var_dump($judul); die;

    // $nama_anggota = $_POST['nama'];
    // $pecahN = explode(".", $nama_anggota);
    // $nim = $pecahN[0];
    $nama_anggota = $_POST['nama'];
    $pecahN = explode(".", $nama_anggota);
    $nim = $pecahN[0];
    $nama = $pecahN[1];

    $sql = $conn->query("SELECT * FROM tb_buku WHERE judul_buku = '$judul'") or die(mysqli_error($conn));
    while($data = $sql->fetch_assoc()) {
        $sisa = $data['jumlah_buku'];

        if($sisa == 0) {
            echo "<script>alert('Stok Buku Habis, Transaksi, tidak dapat dilakukan, silahkan tambahkan stok buku dulu.');window.location='?p=transaksi&aksi=tambah';</script>";
        } else {
            $conn->query("INSERT INTO tb_transaksi VALUES(null, '$id', '$nim', '$nim', '$tgl_pinjam', '$tgl_kembali', 'pinjam')") or die(mysqli_error($conn));
            $conn->query("UPDATE tb_buku SET jumlah_buku = (jumlah_buku-1) WHERE id_buku = '$id'") or die(mysqli_error($conn));
            echo "<script>alert('Data transaksi berhasil ditambahkan.');window.location='?p=transaksi&aksi=tambah';</script>";
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
        <select name="buku" id="nama_buku" class="form-control">
            <option value="">-- Pilih Buku --</option>
            <?php 
            while ($pecahBuku = $tampilNamaBuku->fetch_assoc()) {
            echo "<option value='$pecahBuku[id_buku].$pecahBuku[judul_buku]'>$pecahBuku[judul_buku]</option>";
            
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="nama_anggota">Nama</label>
        <select name="nama" id="nama_anggota" class="form-control">
            <option value="">-- Pilih Anggota --</option>
            <?php 
            while ($pecahAnggota = $tampilNamaAnggota->fetch_assoc()) {
            echo "<option value='$pecahAnggota[id_anggota].$pecahAnggota[nama_anggota]'>$pecahAnggota[nim].$pecahAnggota[nama_anggota]</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tgl_pinjam">Tanggal Pinjam</label>
        <input type="text" name="tgl_pinjam" id="tgl_pinjam" class="form-control" readonly="" value="<?= $tgl_pinjam ?>">
    </div>
    <div class="form-group">
        <label for="tgl_kembali">Tanggal Kembali</label>
        <input type="text" name="tgl_kembali" id="tgl_kembali" class="form-control" readonly="" value="<?= $kembali ?>">
    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
    </div>
	</form>
</div>