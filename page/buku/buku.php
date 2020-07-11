<?php 
// menampilkan DB buku
$ambilBuku = $conn->query("SELECT * FROM tb_buku ORDER BY id_buku DESC") or die(mysqli_error($conn));

?>
<h1 class="mt-4">Data Buku</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">data buku</li>
</ol>
<div class="col-md-6">
    <a href="?p=buku&aksi=tambah" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Buku</a>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data Buku
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>ISBN</th>
                        <th>Jumlah Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($pecahBuku = $ambilBuku->fetch_assoc()) {
                    
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $pecahBuku['judul_buku']; ?></td>
                        <td><?= $pecahBuku['pengarang_buku']; ?></td>
                        <td><?= $pecahBuku['penerbit_buku']; ?></td>
                        <td><?= $pecahBuku['isbn']; ?></td>
                        <td><?= $pecahBuku['jumlah_buku']; ?></td>
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