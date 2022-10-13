<?php

session_start();
include "config/koneksi.php";
error_reporting(0);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>APOTEK - Manajemen Obat</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
</head>

<body>
    <?php
    include "navbar.php";
    ?>
    <div class="container-fluid">
        <div class="card mt-5">
            <div class="card-header">
                Manajemen Obat
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <a href="tambah-obat.php" class="btn btn-outline-primary">+ Tambah Data Obat</a>
                    </div>
                    <div class="col-md-3">
                        <form class="form-inline" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Cari . . ." name="txtcari">
                            </div>
                            <button type="submit" class="btn btn-primary ml-2">Cari</button>
                        </form>
                    </div>
                </div>
                <br />
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Kode Obat</th>
                            <th rowspan="2">Nama Obat</th>
                            <th rowspan="2">Harga</th>
                            <th rowspan="2">Stok</th>
                            <th rowspan="2">Kategori</th>
                            <th rowspan="2">Deskripsi</th>
                            <th rowspan="2">Gambar</th>
                            <th rowspan="2">Aksi</th>
                        </tr>
                        </thead>
                        <?php

                        $txtcari = $_POST['txtcari'];
                        $no = 1;
                        if ($txtcari == !"") {
                            $query = mysqli_query($conn, "SELECT * FROM tbl_obat where 
								kd_obat like '%$txtcari%' OR 
								nm_obat like '%$txtcari%' OR
								harga like '%$txtcari%' OR
								stok like '%$txtcari%' OR
								kategori like '%$txtcari%'");
                        } else {
                            $query = mysqli_query($conn, "SELECT * FROM tbl_obat");
                        }
                        if (mysqli_num_rows($query)) {
                            while ($data = mysqli_fetch_array($query)) { ?>
                        <tbody>   
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?=  $data['kd_obat']; ?></td>
                            <td><?= $data['nm_obat']; ?></td>
                            <td><?= $data['harga']; ?></td>
                            <td><?= $data['stok'];  ?></td>
                            <td><?= $data['kat_obat']; ?></td>
                            <td><?= $data['deskripsi']; ?></td>
                            <td><img src="./images/<?php echo $data['gambar']; ?>" width="60px" height="80px"
                                    alt="<?php echo $data['gambar'] ?>"></td>
                            <td>
                                <a href="edit-obat.php?kd_obat=<?php echo $data['kd_obat']; ?>" class="btn btn-success">Edit
                                </a>
                                <a href="hapus-obat.php?kd=<?php echo $data['kd_obat']; ?>"
                                    class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        </tbody> 
                        <?php            }
                        } else { ?>
                        <tr>
                            <td colspan="10" align="center">Tidak Ada Data</td>
                        </tr>
                        <?php    }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>