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
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>APOTEK - Manajemen Kategori</title>
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
				Manajemen Kategori
			</div>
			<div class="card-body">
			<div class="row">
            <div class="col-md-9">
            <a href="tambah-kategori.php" class="btn btn-outline-primary">+ Tambah Data Kategori</a>
			</div>
            </div>
			<br />
				<table class="table table-bordered table-striped">
					<tr>
						<th>No</th>
						<th>Kategori</th>
						<th>Aksi</th>
					</tr>
					<?php
					include "../../config/koneksi.php";
					$query = mysqli_query($conn,"SELECT * FROM tbl_kategori");
					$no = 1;
					while($data = mysqli_fetch_array($query)){
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['kategori']; ?></td>
							<td>
								<a href="edit-kategori.php?id=<?php echo $data['id_kategori']; ?>" class="btn btn-success">Edit </a>
								<a href="hapus-kategori.php?id=<?php echo $data['id_kategori']; ?>" class="btn btn-danger">Hapus</a>
							</td>
						</tr>
					<?php } ?>	
				</table>
				
			</div>
		</div>
	</div>
</body>
</html>