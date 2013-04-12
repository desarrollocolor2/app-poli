<?php
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$nombrefoto=$_POST['foto'];
//$ruta=$_FILES['foto']['tmp_name'];
$email=$_POST['email'];
$puesto=$_POST['puesto'];
$destino =  "fotos/".$nombrefoto;
//copy($ruta,$destino);

 mysql_connect("localhost","coloral_cargaimg","color");
 mysql_select_db("coloral_cargaimg");
 $consult = mysql_query("select * FROM validacion_acceso WHERE acceso = '$codigo'") or die(mysql_error());
 if((mysql_num_rows($consult)>0)){
 mysql_query("insert into  datos_cargaimg(nombre,foto,email,puesto) values('$nombre','$destino','$email','$puesto')");
 header("Location:index.php");
 }
 else{
	 echo 'no codigo';
 }
?>