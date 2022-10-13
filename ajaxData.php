<?php
include "../../config/koneksi.php";
if($_POST[id]){
	$id=$_POST[id];
	if($id=="0"){?>		
		<option>Masukan Serial ID</option>
		<?php		
	}elseif($id=="ADM"){
		$tampil = mysqli_query($conn,"SELECT id_user FROM tbl_user WHERE id_user LIKE '$_POST[id]%'");
		echo "<option>Masukan Serial ID</option>";
		while ($wadah = mysqli_fetch_array($tampil)) {
			$cek = explode("-", $wadah['id_user']);?>
			<option><?= $cek[1] ?></option>
			<?php
		}
	} elseif($id=="OPT"){
		$tampil = mysqli_query($conn,"SELECT id_user FROM tbl_user WHERE id_user LIKE '$_POST[id]%'");
		echo "<option>Masukan Serial ID</option>";
		while ($wadah = mysqli_fetch_assoc($tampil)) {
			$cek = explode("-", $wadah['id_user']);?>
			<option><?= $cek[1] ?></option>
			<?php			
		}
	} 
}
?>