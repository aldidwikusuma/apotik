<?php
	include ("config/koneksi.php");
	if (isset($_GET['kd'])) {
		$kd = $_GET['kd'];
		$hapus = mysqli_query($conn,"DELETE FROM tbl_pembelian where kd_beli='$kd'");
		if ($hapus) {
			echo "<script>alert('Data Beli Berhasil Dihapus');document.location='histori-pembelian.php'</script>";
		} else {
			echo "<script>alert('Data Beli Gagal Dihapus');document.location='histori-pembelian.php'</script>";
		}
	} else {
		echo "<script>alert('Kode Beli Belum Dipilih');document.location='histori-pembelian.php'</script>";
	}
?>