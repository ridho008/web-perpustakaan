<?php 
// menampilkan DB buku
$ambilAnggota = $conn->query("SELECT * FROM tb_anggota ORDER BY id_anggota DESC") or die(mysqli_error($conn));

?>
<h1 class="mt-4">Data Anggota</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">data anggota</li>
</ol>
<div class="col-md-6">
    <a href="?p=anggota&aksi=tambah" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Anggota</a>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data Anggota
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($pecahAnggota = $ambilAnggota->fetch_assoc()) {
                    $jk = ($pecahAnggota['jk'] == 'L') ? 'Laki-Laki' : 'Perempuan';
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $pecahAnggota['nama_anggota']; ?></td>
                        <td><?= $pecahAnggota['tempat_lahir']; ?></td>
                        <td><?= $pecahAnggota['tgl_lahir']; ?></td>
                        <td><?= $jk; ?></td>
                        <td><?= $pecahAnggota['prodi']; ?></td>
                        <td>
                            <a href="?p=buku&aksi=ubah&id=<?= $pecahBuku['id_buku']; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="?p=buku&aksi=hapus&id=<?= $pecahBuku['id_buku']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" onclick="return confirm('Yakin ?')"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>