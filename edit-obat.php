<?php

session_start();
include "config/koneksi.php";
error_reporting(0);
if (isset($_GET['kd_obat'])) {
	$kd = $_GET['kd_obat'];
} else {
	echo "<script>alert('Kode obat Belum Dipilih');document.location='manajemen-obat.php'</script>";
}
$data = mysqli_query($conn,"SELECT * FROM tbl_obat where kd_obat='$kd'")or die(mysqli_error());
$daftar = mysqli_fetch_array($data);
$dafatrkategori = mysqli_query($conn,"SELECT * FROM tbl_kategori")or die(mysqli_error());

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>APOTEK - Edit Obat</title>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
</head>
<body>
	<?php
	include "navbar.php";
	?>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-7">
				<div class="card">
					<div class="card-body">
						<form action="" method="post" enctype="multipart/form-data">
							<h1>Edit Obat</h1>
							<div class="form-group">
								<input type="hidden" name="kd_buku" value="<?php echo $daftar['kd_obat']; ?>">
								<label for="judul">Kode Obat</label>
								<input type="text" class="form-control" id="kd_obat" placeholder="" required="" name="kd_obat" value="<?php echo $daftar['kd_obat'];?>" readonly="">
							</div>
							<div class="form-group">
								<input type="hidden" name="kd_buku" value="<?php echo $daftar['kd_obat']; ?>">
								<label for="judul">Nama Obat</label>
								<input type="text" class="form-control" id="nm_obat" placeholder="Masukan nama obat" required="" name="nm_obat" value="<?php echo $daftar['nm_obat'];?>">
							</div>
                            <div class="form-group">
								<label for="kat_obat">Kategori</label>
								<select class="form-control" id="kat_obat" name="kat_obat" required="">
									<option><?php echo $daftar['kat_obat'];?></option>
									<?php 
									foreach ($dafatrkategori as $kategori) { ?>
										<option><?php echo $kategori['kategori'];?></option>
									<?php }
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="harga">Harga</label>
								<input type="text" class="form-control" id="harga" placeholder="Masukan Harga" required="" name="harga" value="<?php echo $daftar['harga'];?>">
							</div>
							<div class="form-group">
								<label for="stok">Stok</label>
								<input type="text" class="form-control" id="stok" placeholder="Masukan Stok" required="" name="stok" value="<?php echo $daftar['stok'];?>">
							</div>
							<div class="form-group">
								<label for="deskripsi">Deskripsi</label>
								<input type="text" class="form-control" id="deskripsi" placeholder="Masukan Deskripsi" required="" name="deskripsi" value="<?php echo $daftar['deskripsi'];?>">
							</div>
							<div class="form-group">
								<label for="gambar">Gambar</label>
								<input type="file" class="form-control-file" id="file" name="gambar" value="Images/<?php echo $daftar['gambar'];?>">
							</div>
							<br />
							<input type="submit" class="btn btn-outline-primary" value="Edit" name="edit">
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

if (isset($_POST['edit'])) {

	$kd = $_POST['kd_obat'];
    $ktgr = $_POST['kat_obat'];
	$nm = $_POST['nm_obat'];
	$harga = $_POST['harga'];
	$stok = $_POST['stok'];
	$desk = $_POST['deskripsi'];
	$nama_file = $_FILES['gambar']['name'];
	$source = $_FILES['gambar']['tmp_name'];
	$folder = './images/';

	if($nama_file != '') {

		move_uploaded_file($source, $folder.$nama_file);
		$edit = mysqli_query($conn,"UPDATE tbl_obat SET nm_obat='$nm',kat_obat='$ktgr',harga='$harga', stok='$stok', deskripsi='$desk', gambar='$nama_file' where kd_obat='$kd'");
		if($edit){
			echo "<script>alert('Data obat berhasil diedit'); document.location='manajemen-obat.php'</script>";
		} else {
			echo "<script>alert('Data obat gagal diedit')</script>";
			echo mysqli_error($conn);
		}
	} else {
		move_uploaded_file($source, $folder.$nama_file);
		$edit = mysqli_query($conn,"UPDATE tbl_obat set nm_obat='$nm',kat_obat='$ktgr',harga='$harga', stok='$stok', deskripsi='$desk', where kd_obat='$kd'");
        
		if($edit){
			echo "<script>alert('Data obat berhasil diedit'); document.location='manajemen-obat.php'</script>";
		} else {
			echo "<script>alert('Data obat gagal diedit')</script>";
			echo mysqli_error($conn);
		}
	}
    
}
?>