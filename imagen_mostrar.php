<?php
#Conectamos con la base de datos
$link=mysql_connect("guacamayas.com.co","guacamay_userimg","Codigo2011");
mysql_select_db("guacamay_cargaimg",$link);
$sql = "SELECT * FROM imagephp WHERE id=".$_GET["id"];
echo $sql;
# Buscamos la imagen a mostrar
$result=mysql_query($sql,$link) or die (mysql_error());  

//$row=mysql_fetch_array($result);
while($row=mysql_fetch_array($result)){
echo '<img src="imagenes/'.$row["imagen"].'">';
} 
# Mostramos la imagen
/*header("Content-type:".$row["tipo"]);
echo $row["imagen"];*/
?>
