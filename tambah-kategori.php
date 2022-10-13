<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>APOTEK - Tambah Kategori</title>
</head>
<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-5">
				<div class="card">
					<div class="card-body">
						<form action="" method="post">
							<h1>Tambah Kategori</h1>
							<div class="form-group">
								<label for="kategori">Kategori Baru</label>
								<input type="text" class="form-control" id="kategori" placeholder="Masukan Kategori Baru" required="" name="kategori">
							</div>
							<input type="submit" class="btn btn-outline-primary" value="Tambah" name="tambah">
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

include "config/koneksi.php";
if(isset($_POST['tambah'])){

	$ktgr = $_POST['kategori'];
	$cek = mysqli_query($conn,"SELECT * FROM tbl_kategori where kategori='$ktgr'");
	if(mysqli_num_rows($cek) > 0){
		echo "
		<div class='alert alert-danger' role='alert' align='center'>
		Kategori sudah ada !
		</div>";
	} else {
		$save = mysqli_query($conn,"INSERT INTO tbl_kategori (kategori) VALUES ('$ktgr')");
		if($save){
			echo "<script>alert('Kategori Berhasil Ditamabah')</script>";
		} else {
			echo "<script>alert('GAGAL !')</script>";
			echo mysqli_error($conn);
		}
	}
}
?>