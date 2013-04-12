<?php
$documento = $_POST['documento'];
$nombre=$_POST['nombre'];
$ciudad=$_POST['ciudad'];
$telefono=$_POST['telefono'];
$email=$_POST['email'];
$estudio=$_POST['estudio'];
$modalidad=$_POST['modalidad'];
$tipo_programa=$_POST['tipo_programa'];
$programa=$_POST['programa'];
$nombrefoto=$_POST['foto'];
$puesto=$_POST['puesto'];
//$ruta=$_FILES['foto']['tmp_name'];
if($modalidad == 1){
	$modalidad = 'Presencial';
}
else{
	$modalidad = 'Virtual';
}
if($tipo_programa == 1){
	$tipo_programa = 'Pregrado';
}
else{
	$tipo_programa = 'Posgrado';
}

$destino =  $nombrefoto;
//copy($ruta,$destino);

 mysql_connect("localhost","coloral_cargaimg","color");
 mysql_select_db("coloral_cargaimg");
 
//consultas datos
 
$consult_data = mysql_query("SELECT * FROM `users` WHERE documento = '$documento' or email = '$email' or puesto = '$puesto'"); 
 
// inserta datos 
 if((mysql_num_rows($consult_data)>0)){
      echo 'sus datos ya estan registrados';
 }
 else{
	 
 mysql_query("INSERT INTO `users`(`documento`, `nombre`, `ciudad`, `telefono`, `email`, `estudio`, `modalidad`,`tipo_programa`,`programa`, `foto`, `puesto`) VALUES('$documento','$nombre','$ciudad','$telefono','$email','$estudio','$modalidad','$tipo_programa','$programa','$destino','$puesto')");
  }
 
 

?>