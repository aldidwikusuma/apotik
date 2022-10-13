<?php

session_start();
include "config/koneksi.php";
error_reporting(0);
if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	echo "<script>alert('Kode Buku Belum Dipilih');document.location='manajemen-kategori.php'</script>";
}
$data = mysqli_query($conn,"SELECT * FROM tbl_kategori where id_kategori='$id'");
$daftar = mysqli_fetch_array($data);

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>APOTEK - Edit Kategori</title>
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
			<div class="col-md-5">
				<div class="card">
					<div class="card-body">
						<form action="" method="post">
							<h1>Edit Kategori</h1>
							<div class="form-group">
								<input type="hidden" name="id_kategori" value="<?php echo $daftar['id_kategori']; ?>">
								<label for="kategori">Nama Kategori</label>
								<input type="text" class="form-control" id="kategori" placeholder="Ganti nama kategori" required="" name="kategori" value="<?php echo $daftar['kategori']; ?>">
							</div>
							<input type="submit" class="btn btn-outline-primary" value="Edit" name="edit">
							<a class="btn btn-outline-primary" href="manajemen-kategori.php" role="button">Kembali</a>
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

	$id = $_POST['id_kategori'];
	$ktgr = $_POST['kategori'];
	$edit = mysqli_query($conn,"UPDATE tbl_kategori set kategori='$ktgr' where id_kategori='$id'");
	if($edit){
		echo "<script>alert('Katagori berhasil diedit'); document.location='manajemen-kategori.php'</script>";
	} else {
		echo "<script>alert('Kategori gagal diedit')</script>";
		echo mysqli_error($conn);
	}
	var_dump($edit);
}
?>