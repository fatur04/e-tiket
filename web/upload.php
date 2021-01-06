<?php
session_start();
include 'koneksi.php';
//upload.php

if(!empty($_FILES))
{
	if(is_uploaded_file($_FILES['uploadFile']['tmp_name']))
	{
		sleep(1);
		$source_path = $_FILES['uploadFile']['tmp_name'];
		$target_path = '../foto event/' . $_FILES['uploadFile']['name'];
		$foto = $_FILES['uploadFile']['name'];
		
		if(move_uploaded_file($source_path, $target_path))
		{
			echo '<img src="'.$target_path.'" class="img-thumbnail" width="825px" height="460" />';
		}

		// $koneksi->query("INSERT INTO event (foto_event) VALUES ('$foto') ");
		
		// $tampil = mysqli_query($koneksi, "SELECT LAST_INSERT_ID()");
		// 		while ($r=mysqli_fetch_array($tampil)){
		// 		$id = $r[0];
		// 		}
		echo $_SESSION["buat"] = $id;
		$_SESSION["foto"] = $foto;
	}
}

?>