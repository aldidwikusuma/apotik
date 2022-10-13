<?php
session_start();
include "config/koneksi.php";
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Perpustakaan - Tambah User</title>
</head>
<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-5">
				<div class="card">
					<div class="card-body">
						<form action="" method="post" enctype="multipart/form-data">
							<h1 align="center">Tambah User</h1>
                            <div class="form-group">
								<label for="nm_user">Nama</label>
								<input type="text" class="form-control" id="nm_user" placeholder="Masukan Nama" name="nm_user" required="">
							</div>
                            <div class="form-group">
								<label for="jenis_kelamin">jenis Kelamin</label>
								<select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required="">
									<option>Masukan Jenis Kelamin</option>
									<option value="Laki-Laki">Laki-Laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label for="tp_lahir">Tempat Lahir</label>
								<input type="text" class="form-control" id="tp_lahir" placeholder="Tempat Lahir" name="tp_lahir" required="">
							</div>
							<div class="form-group">
								<label for="tgl_lahir">Tanggal Lahir</label>
								<input type="date" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" name="tgl_lahir" required="">
							</div>
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" required="">
							</div>
							<div class="form-group">
								<label for="no_telp">Nomor Telepon</label>
								<input type="text" class="form-control" id="no_telp" placeholder="Nomor Telepon" name="no_telp" required="">
							</div>
                            <div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" placeholder="Masukan Username" required="" name="username">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="text" class="form-control" id="password" placeholder="Masukan Password" required="" name="password">
							</div>
							<div class="form-group">
								<label for="level">Level</label>
								<select class="form-control" id="level" name="level">
									<option>Pilih Salah Satu..</option>
									<option value="admin">Admin</option>
									<option value="user">User</option>
								</select>
							</div>
							<br />
							<input type="submit" class="btn btn-outline-primary" value="Tambah" name="tambah">
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
if (isset($_POST['tambah'])) {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $name = $_POST['nm_user'];
    $jk = $_POST['jenis_kelamin'];
	$tp_lahir = $_POST['tp_lahir'];
	$tgl_lahir = $_POST['tgl_lahir'];
	$almt = $_POST['alamat'];
	$no_telp = $_POST['no_telp'];
	$username = $_POST['username'];
	$pass = $_POST['password'];
	$level = $_POST['level'];
	$cek = mysqli_query($conn,"SELECT * FROM tbl_user where username='$username'");
	if(mysqli_num_rows($cek) > 0){
		echo "
		<script>alert('Username Sudah Ada !')</script>";
	} else {
		$save = mysqli_query($conn,"INSERT INTO tbl_user (nm_user,jenis_kelamin,tp_lahir,tgl_lahir,alamat,no_telp,username,password,level) VALUES ('$name', '$jk', '$tp_lahir', '$tgl_lahir', '$almt', '$no_telp', '$username','$pass','$level')");
		if($save){
			echo "<script>alert('User Berhasil Ditamabah')</script>";
		} else {
			echo "<script>alert('GAGAL !')</script>";
			echo mysqli_error($conn);
		}
	}
    var_dump($save);
}
?>