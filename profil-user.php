<?php 
session_start();
include "config/koneksi.php";
error_reporting(0);

$a = $_SESSION['id'];
$user = mysqli_query($conn, "SELECT * FROM tbl_user where id_user='$a'");
$user1 = mysqli_fetch_array($user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>APOTEK - Profil User</title>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
</head>
<body>
<?php
	include "navbar.php";

	if (isset($_SESSION['level'])) {
		if ($_SESSION['level'] == "admin") { 
			
	?>	
<div class="container-fluid">
		<div class="card mt-5">
			<div class="card-header">
				Profil User
			</div>
            <div class="form-group">
                <label class="col-sm-2 control-label">ID User</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['id_user']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">Nama User</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['nm_user']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">Username</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['username']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">Jenis Kelamin</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['jenis_kelamin']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">Tempat Lahir</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['tp_lahir']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">Tanggal Lahir</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['tgl_lahir']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">Alamat</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['alamat']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">No Telepon</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['no_telp']; ?></label>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label"><a class="btn btn-primary" href="edit-user.php?id=<?= $a ?>" role="button" name="edit">Edit</a></label>
			<a class="btn btn-outline-primary" href="index.php" role="button">Kembali</a>
            </div>

			<?php    } elseif ($_SESSION['level'] == "user") { 
    		?>
			<div class="container-fluid">
		<div class="card mt-5">
			<div class="card-header">
				Profil User
			</div>
            <div class="form-group">
                <label class="col-sm-2 control-label">ID User</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['id_user']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">Nama User</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['nm_user']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">Username</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['username']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">Jenis Kelamin</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['jenis_kelamin']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">Tempat Lahir</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['tp_lahir']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">Tanggal Lahir</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['tgl_lahir']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">Alamat</label>
                <label class="col-sm-8 control-label">: <?php echo $user1['alamat']; ?></label>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">No Telepon :</label>
                <label class="col-sm-8 control-label"><?php echo $user1['no_telp']; ?></label>
            </div>
            <div class="form-group">
            <label class="col-sm-1 control-label"><a class="btn btn-primary" href="edit-user.php?id=<?= $a ?>" role="button" name="edit">Edit</a></label>
			<label class="col-sm-8 control-label"><a class="btn btn-outline-primary" href="index.php" role="button">Kembali</a></label>
            </div>
			<?php }
			}
			?>	
        </div>    
</div>

</body>
</html>