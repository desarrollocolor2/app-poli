<?php
    $valido = $_POST['valido'];
	$ruta = "fotos/";
	$carpeta="tmp/";
	if($valido){
		$name=$ruta.basename($_FILES['image']['name']);
    	move_uploaded_file($_FILES['image']['tmp_name'],$name);
	}
	else{
		$name=$carpeta.basename($_FILES['image']['name']);
		move_uploaded_file($_FILES['image']['tmp_name'],$name);
		echo '<img class="tmp_image" src="'.$name.'" width="50" height="50"/>';
	}
?>

