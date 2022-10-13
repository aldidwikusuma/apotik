<?php
session_start();
include "config/koneksi.php";
$daftarkategori = mysqli_query($conn, "SELECT * FROM tbl_kategori");

$ambil = mysqli_query($conn, "SELECT max(kd_obat) as maxKode FROM tbl_obat");

$tampung = mysqli_fetch_array($ambil);
$kd = $tampung['maxKode'];
$noUrut = (int) substr($kd, 4, 4);
$noUrut++;
$char = "KDO-";
$kd_obat = $char . sprintf("%03s", $noUrut);

if (isset($_POST['tambah'])) {

    $kd_obat = $kd_obat;
    $ktgr = $_POST['kat_obat'];
    $nm_obat = $_POST['nm_obat'];
    $hrg = $_POST['harga'];
    $stk = $_POST['stok'];
    $desk = $_POST['deskripsi'];
    $nama_file = $_FILES['gambar']['name'];
    $source = $_FILES['gambar']['tmp_name'];
    $folder = './images/';
    move_uploaded_file($source, $folder . $nama_file);
    $simpan =mysqli_query($conn, "INSERT INTO tbl_obat
		(kd_obat,kat_obat,nm_obat,harga,stok,deskripsi,gambar) VALUES 
		('$kd_obat','$ktgr','$nm_obat','$hrg','$stk','$desk','$nama_file')");
    
   
     
     if ($simpan) {
         echo "<script>
	  	document.location='manajemen-obat.php';
	 	alert('Data obat berhasil disimpan')
        
         </script>";
    } else {
         echo "<script>alert('Data obat berhasil disimpan')</script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <title>APOTEK - Tambah Obat</title>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <h1>Tambah Obat</h1>
                            <div class="form-group">
                                <label for="kd_obat">Kode Obat</label>
                                <input type="text" class="form-control disabled" id="kd_obat" required="" name="kd_obat"
                                    value="<?= $kd_obat; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nm_obat">Nama Obat</label>
                                <input type="text" class="form-control" id="nm_obat" placeholder="Masukan Nama Obat"
                                    required="" name="nm_obat">
                            </div>
                            <div class="form-group">
                                <label for="kat_obat">Kategori</label>
                                <select class="form-control" id="kat_obat" name="kat_obat">
                                    <option>Pilih Salah Satu..</option>
                                    <?php
                                    while ($dataobat = mysqli_fetch_array($daftarkategori)) { ?>
                                    <option value="<?php echo $dataobat['kategori']; ?>">
                                        <?php echo $dataobat['kategori']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" class="form-control" id="harga" placeholder="Masukan Harga"
                                    required="" name="harga">
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="text" class="form-control" id="stok" placeholder="Masukan Stok" required=""
                                    name="stok">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <input type="text" class="form-control" id="deskripsi" placeholder="Masukan Deskripsi"
                                    required="" name="deskripsi">
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar Obat</label>
                                <input type="file" class="form-control-file" id="file" name="gambar">
                            </div>
                            <br />
                            <input type="submit" class="btn btn-outline-primary" value="Tambah" name="tambah">
                            <a class="btn btn-outline-primary" href="manajemen-obat.php" role="button">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php


?>