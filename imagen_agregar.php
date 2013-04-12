<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
/*
La base de datos utilizada para el ejemplo se llama imagenes

CREATE TABLE IF NOT EXISTS `imagephp` (
  `id` smallint(6) NOT NULL auto_increment,
  `anchura` smallint(6) NOT NULL,
  `altura` smallint(6) NOT NULL,
  `tipo` char(15) NOT NULL,
  `imagen` mediumblob NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php
# Conectamos con la base de datos
$link=mysql_connect("guacamayas.com.co","guacamay_userimg","Codigo2011");
mysql_select_db("guacamay_cargaimg",$link);
//echo "<BR>".$_FILES["userfile"]["name"];		//nombre del archivo
//echo "<BR>".$_FILES["userfile"]["type"];		//tipo
//echo "<BR>".$_FILES["userfile"]["tmp_name"];	//nombre del archivo de la imagen temporal
//echo "<BR>".$_FILES["userfile"]["size"];		//tamaño

# Comprovamos que se haya subido un fichero
if (is_uploaded_file($_FILES["userfile"]["tmp_name"]))
{
	# Cogemos el formato de la imagen
	if ($_FILES["userfile"]["type"]=="image/jpeg" || $_FILES["userfile"]["type"]=="image/pjpeg" || $_FILES["userfile"]["type"]=="image/gif" || $_FILES["userfile"]["type"]=="image/bmp" || $_FILES["userfile"]["type"]=="image/png")
	{
		# Cogemos la anchura y altura de la imagen
		$info=getimagesize($_FILES["userfile"]["tmp_name"]);
		//echo "<BR>".$info[0]; //anchura
		//echo "<BR>".$info[1]; //altura
		//echo "<BR>".$info[2]; //1-GIF, 2-JPG, 3-PNG
		//echo "<BR>".$info[3]; //cadena de texto para el tag <img

		# Escapa caracteres especiales
		$imagenEscapes=mysql_real_escape_string(file_get_contents($_FILES["userfile"]["tmp_name"]));

		# Agregamos la imagen a la base de datos
		$result=mysql_query("INSERT INTO imagephp (anchura,altura,tipo,imagen) VALUES (".$info[0].",".$info[1].",'".$_FILES["userfile"]["type"]."','".$imagenEscapes."')",$link);
		# Cogemos el identificador con que se ha guardado
		$id=mysql_insert_id();

		# Mostramos la imagen agregada
		echo "Imagen agregada con el id ".$id."<BR>";
		echo "<img src='imagen_mostrar.php?id=".$id."' width='".$info[0]."' height='".$info[1]."'>";
	}else{
		$error="El formato de archivo tiene que ser JPG, GIF, BMP o PNG.";
	}
}else{
	$error="No ha seleccionado ninguna imagen...";
}

if ($error!="")
{
	echo "</center><P><font face='Arial' size=2 color='#ff0000'> Error: ".$error."</font><br>";
}
?>

<form ENCTYPE="multipart/form-data" action="imagen_agregar.php" method="POST">
	<INPUT NAME="userfile" TYPE="file">
	<p><input type="submit" value="Guardar Imagen">
</form>
</body>
</html>