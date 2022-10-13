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
	<title>APOTEK - Manajemen User</title>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
</head>
<body>
	<?php
	include "navbar.php"
	?>
	<div class="container-fluid">
		<div class="card mt-5">
		<div class="card-header">
			Manajemen User
		</div>
			<div class="card-body">
			<div class="row">
                    <div class="col-md-9">
					<a href="tambah-user.php" class="btn btn-outline-primary">+ Tambah Data User</a>
                    </div>
                    <div class="col-md-3">
                        
                    </div>
                </div>
                <br />
				<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Tempat Lahir</th>
						<th>Tanggal Lahir</th>
						<th>Alamat</th>
						<th>Nomor Telepon</th>
						<th>Username</th>
						<th>Password</th>
						<th>Level</th>
						<th>Aksi</th>
					</tr>
					<?php
					include "config/koneksi.php";
					$query = mysqli_query($conn,"SELECT * FROM tbl_user");
					$no = 1;
					while($data = mysqli_fetch_array($query)){
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?= $data['nm_user']; ?></td>
							<td><?php echo $data['jenis_kelamin']; ?></td>
							<td><?php echo $data['tp_lahir']; ?></td>
							<td><?php echo $data['tgl_lahir']; ?></td>
							<td><?php echo $data['alamat']; ?></td>
							<td><?php echo $data['no_telp']; ?></td>
							<td><?php echo $data['username']; ?></td>
							<td><?php echo $data['password']; ?></td>
							<td><?php echo $data['level']; ?></td>
							<td>
								<a href="edit-user.php?id=<?php echo $data['id_user']; ?>" class="btn btn-success">Edit </a>
								<a href="hapus-user.php?id=<?php echo $data['id_user']; ?>" class="btn btn-danger">Hapus</a>
							</td>
						</tr>
					<?php } ?>	
				</table>
				</div>
			</div>
		</div>
	</div>	
</body>
</html>