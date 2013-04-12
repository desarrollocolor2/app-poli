<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>

<body>

<script type="text/javascript">
var keylist="abcdefghijklmnopqrstuvwxyzñABCDEFGHIJKLMNOPQRSTUVWXYZÑ123456789"
var temp=''

function generatepass(plength){
temp=''
for (i=0;i<plength;i++)
temp+=keylist.charAt(Math.floor(Math.random()*keylist.length)) 
return temp
}
var codigo = generatepass(6);
function populateform(enterlength){
document.pgenerate.output.value=generatepass(enterlength);
}
</script>
  <form name="pgenerate">
    
      <input name="thelength" type="text" class="style3" value="6" size=3>
      <input type="button" class="style3" onClick="populateform(this.form.thelength.value)" value="Creer una Contraseña">
      <input name="output" type="text" class="outut" size=24>
  </form>
<script type="text/javascript">
	$(".style3").click();
</script>  
	<?php
	 $codigo = '<script>document.write(codigo)</script>';
	 echo $codigo;
	 mysql_connect("localhost","coloral_cargaimg","color");
	 mysql_select_db("coloral_cargaimg");
	 $consult = mysql_query("select * FROM validacion_acceso WHERE acceso = '$codigo'") or die(mysql_error());
	 $consult2 = mysql_query("select * FROM validacion_acceso") or die(mysql_error());
	 $limit = mysql_num_rows($consult2);
	 echo $limit;
	 //echo $codigo;
	 if((mysql_num_rows($consult)>0)){
	 //mysql_query("insert into  validacion_acceso(acceso) values('$codigo')");
	 }
	 else{
		// mysql_query("insert into  validacion_acceso(acceso) values('$codigo')");
	 }
	?>

</body>
</html>