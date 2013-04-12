<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>

<body>


	<?php
	function random(){
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";
		for($i=0;$i<6;$i++) {
		$cad .= substr($str,rand(0,62),1);
		}
		return $cad;
	}

	 $codigo = random();
	 
	 mysql_connect("localhost","coloral_cargaimg","color");
	 mysql_select_db("coloral_cargaimg");
	 $consult = mysql_query("select * FROM codigos WHERE codigo = '$codigo'") or die(mysql_error());
	 $consult2 = mysql_query("select * FROM codigos") or die(mysql_error());
	 $limit = mysql_num_rows($consult2);
	 //echo 'total'.$limit;
	 
	 while ($limit<=5){
		 $codigo = random();
		 echo $codigo.'</br>';
		 if((mysql_num_rows($consult)>0)){
			
		 }
		 else{
		  mysql_query("insert into codigos(codigo) values('$codigo')");
		  $limit ++; 
		 }
	 }
	?>

</body>
</html>