<?php

session_start();
include "config/koneksi.php";
error_reporting(0);
if (isset($_GET['kd'])) {
	$kd = $_GET['kd'];
} else {
	// echo "<script>alert('Kode Obat Belum Dipilih');document.location='index.php'</script>";
	// echo "<script>alert('Id User Belum Dipilih');document.location='index.php'</script>";
}
$data = mysqli_query($conn,"SELECT * FROM tbl_obat where kd_obat='$kd'");
$daftar = mysqli_fetch_array($data);
$ambil = mysqli_query($conn,"SELECT max(kd_beli) as maxKode FROM tbl_pembelian");
$tampung = mysqli_fetch_array($ambil);
$kd = $tampung['maxKode'];
$noUrut = (int) substr($kd, 4, 4);
$noUrut++;
$char= "TB-";
$kd_beli = $char . sprintf("%03s", $noUrut);

date_default_timezone_set("Asia/Jakarta");
$tgl_beli = date("d-m-Y H:i:s");

if(isset($_POST['beli'])){
    $kd_bl = $kd_beli;
    $id_usr = $_SESSION['id'];
    $kd_obat = $_POST['kd_obat'];
    $tgl_beli = $_POST['tgl_beli'];
    $jml_beli = $_POST['jml_beli'];
    $simpan = mysqli_query($conn, "INSERT INTO tbl_pembelian (kd_beli,id_user,kd_obat,tgl_beli,jml_beli) VALUES 
    ('$kd_bl', '$id_usr', '$kd_obat', '$tgl_beli', '$jml_beli')");

    if ($simpan) {
        ?>
        <Script>
			alert('Pembelian Berhasil');
			document.location="index.php";
			</Script>
            <?php
    }
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>APOTEK - Transaksi Obat</title>
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
						<form action="" method="post">
							<h1 align="center">Beli Obat</h1>
							<div class="form-group">
								<label for="kd_transaksi">Kode Beli</label>
								<input type="text" class="form-control" id="kd_transaksi" placeholder="Masukan Kode Transaksi" required="" name="kd_transaksi" value="<?php echo $kd_beli;?>" readonly="">
							</div>
                            <div class="form-group">
                                <label>Kode Obat</label>
                                <select class="form-control" name="kd_obat" onchange="changeValue(this.value)" required>
	 					        <option value=0>-Pilih-</option>
	 				                <?php 
	 					            $query = mysqli_query($conn, "SELECT * FROM tbl_obat");
	 					            $jsarray = "var dtobat = new Array();\n";
	 					            while ($row = mysqli_fetch_array($query)) {
	 					            ?>
	 						    <option value="<?= $row['kd_obat'] ?>"><?= $row['kd_obat'] ?></option>
	 				                <?php
	 						        $jsarray .= "dtobat['".$row['kd_obat']."'] = { kategori:'".addslashes($row['kat_obat'])."', nama:'".addslashes($row['nm_obat'])."'};\n";
	 					            }
	 				                ?>
	 				            </select>
                            </div>
                            <div class="form-group">
								<label for="kat_obat">Kategori Obat</label>
								<input type="text" class="form-control" id="kat_obat" required="" name="kat_obat" readonly="">
							</div>
                            <div class="form-group">
								<label for="nm_obat">Nama Obat</label>
								<input type="text" class="form-control" id="nm_obat" required="" name="nm_obat" readonly="">
							</div>
                            <div class="form-group">
								<label for="tgl_beli">Tanggal Transaksi</label>
								<input type="text" class="form-control" required="" name="tgl_beli" value="<?php echo $tgl_beli;?>" readonly="">
							</div>
                            <div class="form-group">
								<label for="jml_beli">Jumlah</label>
								<input type="number" class="form-control" id="jml_beli" placeholder="Masukan Jumlah Beli" required="" name="jml_beli">
							</div>
							<br />
							<input type="submit" class="btn btn-outline-primary" value="Beli" name="beli">
							<a class="btn btn-outline-primary" href="index.php" role="button">Kembali</a>
						</form>
                        <script type="text/javascript">
	 	                    <?php echo $jsarray; ?>
	 	                        function changeValue(id){
	 		                    document.getElementById('kat_obat').value = dtobat[id].kategori; 
	 		                    document.getElementById('nm_obat').value = dtobat[id].nama;
	 	                        }
	                    </script>
                        
				</div>
			</div>
		</div>
	</div>
</body>
</html>        