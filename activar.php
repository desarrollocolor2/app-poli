<?php
$documento = $_POST['documento'];
$email=$_POST['email'];
$puesto=$_POST['puesto'];
$codigo = $_POST['codigo'];


 mysql_connect("localhost","coloral_cargaimg","color");
 mysql_select_db("coloral_cargaimg");
 
// consulta codigo
 $consulta_emailcodigo = mysql_query("SELECT * FROM codigos WHERE codigo='$codigo' and email='$email'");
 
 if((mysql_num_rows($consulta_emailcodigo)>0)){
	 mysql_query("INSERT INTO `puestos`(`puesto`, `documento`, `email`, `codigo`) VALUES('$puesto','$documento','$email','$codigo')");
 }
 else
 {
	 echo 'email y codigo no coinciden';
  }
?>