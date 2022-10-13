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
	<title>APOTEK - Edit User</title>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
</head>
<body>
	<?php
	include "navbar.php";
	?>
	<?php 	
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		echo "<script>alert('Kode User Belum Dipilih');document.location='manajemen-user.php'</script>";
	}
	$data = mysqli_query($conn,"SELECT * FROM tbl_user where id_user='$id'");
	$daftar = mysqli_fetch_array($data);
	
	if (isset($_SESSION['level'])) {
		if ($_SESSION['level'] == "admin") {
	?>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-5">
				<div class="card">
					<div class="card-body">
						<form action="" method="post">
							<h1>Edit User</h1>
							<div class="form-group">
								<input type="hidden" name="id_user" value="<?php echo $daftar['id_user']; ?>">
								<label for="user">Nama</label>
								<input type="text" class="form-control" id="nm_user" placeholder="Ganti nama" required="" name="nm_user" value="<?php echo $daftar['nm_user']; ?>">
							</div>
							<div class="form-group">
									<label for="jenis_kelamin">Jenis Kelamin</label>
									<select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required="">
										<option><?= $tampung['jenis_kelamin']?></option>
										<option value="Laki-Laki">Laki-Laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
							<div class="form-group">
								<label for="tp_lahir">Tempat Lahir</label>
								<input type="text" class="form-control" id="tp_lahir" placeholder="Tempat Lahir" name="tp_lahir" required="" value="<?php echo $daftar['tp_lahir']; ?>">
							</div>
							<div class="form-group">
								<label for="tgl_lahir">Tanggal Lahir</label>
								<input type="date" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" name="tgl_lahir" required="" value="<?php echo $daftar['tgl_lahir']; ?>">
							</div>
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" required="" value="<?php echo $daftar['alamat']; ?>">
							</div>
							<div class="form-group">
								<label for="no_telp">Nomor Telepon</label>
								<input type="text" class="form-control" id="no_telp" placeholder="Nomor Telepon" name="no_telp" required="" value="<?php echo $daftar['no_telp']; ?>">
							</div>	
							<div class="form-group">
								<label for="user">Nama Username</label>
								<input type="text" class="form-control" id="user" placeholder="Ganti nama Username" required="" name="username" value="<?php echo $daftar['username']; ?>">
							</div>
							<div class="form-group">
								<label for="password">Password User</label>
								<input type="text" class="form-control" id="password" placeholder="Ganti Password User" required="" name="password" value="<?php echo $daftar['password']; ?>">
							</div>
							<div class="form-group">
								<label for="level">Level</label>
								<select class="form-control" id="level" name="level">
									<option><?php echo $daftar['level'];?></option>
									<option value="admin">Admin</option>
									<option value="user">User</option>
								</select>
							</div>
							<input type="submit" class="btn btn-outline-primary" value="Edit" name="edit">
							<a class="btn btn-outline-primary" href="manajemen-user.php" role="button">Kembali</a>
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

	$id = $_POST['id_user'];
	$name = $_POST['nm_user'];
	$jk = $_POST['jenis_kelamin'];
	$tplahir = $_POST['tp_lahir'];
	$tgllahir = $_POST['tgl_lahir'];
	$alamat = $_POST['alamat'];
	$notelp = $_POST['no_telp'];
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$level = $_POST['level'];
	$edit = mysqli_query($conn,"UPDATE tbl_user set nm_user='$name', jenis_kelamin='$jk', tp_lahir='$tplahir', tgl_lahir='$tgllahir', alamat='$alamat', no_telp='$notelp', username='$user', password='$pass', level='$level' where id_user='$id'");
	if($edit){
		echo "<script>alert('User berhasil diedit'); document.location='manajemen-user.php'</script>";
	} else {
		echo "<script>alert('User gagal diedit')</script>";
		echo mysqli_error($conn);
	}
	var_dump($edit);
}

} elseif ($_SESSION['level'] == "user") {
?>
<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-5">
				<div class="card">
					<div class="card-body">
						<form action="" method="post">
							<h1>Edit User</h1>
							<div class="form-group">
								<input type="hidden" name="id_user" value="<?php echo $daftar['id_user']; ?>">
								<label for="user">Nama</label>
								<input type="text" class="form-control" id="nm_user" placeholder="Ganti nama" required="" name="nm_user" value="<?php echo $daftar['nm_user']; ?>">
							</div>
							<div class="form-group">
									<label for="jenis_kelamin">Jenis Kelamin</label>
									<select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required="">
										<option><?= $tampung['jenis_kelamin']?></option>
										<option value="Laki-Laki">Laki-Laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
							<div class="form-group">
								<label for="tp_lahir">Tempat Lahir</label>
								<input type="text" class="form-control" id="tp_lahir" placeholder="Tempat Lahir" name="tp_lahir" required="" value="<?php echo $daftar['tp_lahir']; ?>">
							</div>
							<div class="form-group">
								<label for="tgl_lahir">Tanggal Lahir</label>
								<input type="date" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" name="tgl_lahir" required="" value="<?php echo $daftar['tgl_lahir']; ?>">
							</div>
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" required="" value="<?php echo $daftar['alamat']; ?>">
							</div>
							<div class="form-group">
								<label for="no_telp">Nomor Telepon</label>
								<input type="text" class="form-control" id="no_telp" placeholder="Nomor Telepon" name="no_telp" required="" value="<?php echo $daftar['no_telp']; ?>">
							</div>	
							<div class="form-group">
								<label for="user">Nama Username</label>
								<input type="text" class="form-control" id="user" placeholder="Ganti nama Username" required="" name="username" value="<?php echo $daftar['username']; ?>">
							</div>
							<div class="form-group">
								<label for="password">Password User</label>
								<input type="text" class="form-control" id="password" placeholder="Ganti Password User" required="" name="password" value="<?php echo $daftar['password']; ?>">
							</div>
							<input type="submit" class="btn btn-outline-primary" value="Edit" name="edit">
							<a class="btn btn-outline-primary" href="manajemen-user.php" role="button">Kembali</a>
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

	$id = $_POST['id_user'];
	$name = $_POST['nm_user'];
	$jk = $_POST['jenis_kelamin'];
	$tplahir = $_POST['tp_lahir'];
	$tgllahir = $_POST['tgl_lahir'];
	$alamat = $_POST['alamat'];
	$notelp = $_POST['no_telp'];
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$edit = mysqli_query($conn,"UPDATE tbl_user set nm_user='$name', jenis_kelamin='$jk', tp_lahir='$tplahir', tgl_lahir='$tgllahir', alamat='$alamat', no_telp='$notelp', username='$user', password='$pass' where id_user='$id'");
	if($edit){
		echo "<script>alert('User berhasil diedit'); document.location='profil-user.php'</script>";
	} else {
		echo "<script>alert('User gagal diedit')</script>";
		echo mysqli_error($conn);
	}
	var_dump($edit);
}
}
	}
?>