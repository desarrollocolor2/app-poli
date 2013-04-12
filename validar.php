<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="jquery.form.js" type="text/javascript"></script>
<script src="jquery.validate.js" type="text/javascript"></script>
<script src="http://cdn.jquerytools.org/1.2.7/tiny/jquery.tools.min.js"></script>
<style type="text/css">
  .puesto{
	  width:50px;
	  height:50px;
	  border:1px solid #ccc;
	  background:#f1f1f1;
	  float:left;
	  margin:10px;
  }
  .puesto.selected{
	  border:1px solid #000;
  }
  .cod_container{
	  display:none;
  }
  .clear{
	  width:100%;
	  clear:both;  
  }
  .puesto_cont{
  }
  .info_dialog{
	  display:none;
  }
  .puestos_container{
	  width:980px;
	  margin:0 auto;
  }
  .profile_thumb{
	 width:50px;
	 height:50px;
  }
  .profile_pic img{
	  width:50px;
	 height:50px;
  }
  #show_preview, #save_profile{
	  display:none;
  }
  </style>
</head>
<body>
<form id="login_form" action="activar.php" name="form" enctype="multipart/form-data" method="post" >
  
  <label>
  documento
  <input name="documento" type="text" id="documento" required="required">
  </label>
  
  <label>
  email
  <input name="email" type="email" id="email" required="required">
  </label> 
  <br>
  <label>
  codigo acceso
  <input name="codigo" type="text" id="codigo" required="required">
  </label>
  <br>
  <label>
  puesto
  <input name="puesto" type="text" id="puesto" required="required">
  </label> 
  <label>
  <input id="action1" type="submit" name="Submit" value="Subir">
  </label>
</form>


 <?php
 mysql_connect("localhost","coloral_cargaimg","color");
 mysql_select_db("coloral_cargaimg");  
 $re=mysql_query("SELECT * FROM users,puestos WHERE users.documento=puestos.documento") or die(mysql_error());
 echo '<div class="cod_container">';
 while($f=mysql_fetch_array($re)){
 	echo'<div class="puesto_cont" id="'.$f['puesto'].'"><div class="info_dialog">'.$f['nombre'].'<br>'.$f['email'].'</div><img class="profile_thumb" src="'.$f['foto'].'"/></div>';
 }
 echo '</div>';
?>
<div class="puestos_container">
<?php for($i=1; $i<=60;$i++){ 
		//if($i==$f['codigo'])
?>
		<div class="puesto" id="p<?php echo $i?>"></div>
<?php } ?>
<div class="clear"></div>
</div>

<script type="text/javascript">
/*function loadname(img, previewName){  

var isIE = (navigator.appName=="Microsoft Internet Explorer");  
var path = img.value;  
var ext = path.substring(path.lastIndexOf('.') + 1).toLowerCase();  

 if(ext == "gif" || ext == "jpeg" || ext == "jpg" ||  ext == "png" )  
 {       
    if(isIE) {  
       $('#'+ previewName).attr('src', path);  
    }else{  
       if (img.files[0]) 
        {  
            var reader = new FileReader();  
            reader.onload = function (e) {  
                $('#'+ previewName).attr('src', e.target.result);  
            }
            reader.readAsDataURL(img.files[0]);  
        }  
    }  

 }else{  
 }   
}  



$(document).ready(function() {
  $(".x").click(function() {
    $(".img_prev").attr("src",blank);
    $(".x").hide();  
  });
});*/

$(function(){
	$(".puesto").click(function(){
		
		var pcheck = $(this).attr("id");
		var cont = $(this).html();
		if(cont==""){
			$("#puesto").val(pcheck);
			$(".puesto").removeClass("selected");
			$(this).addClass("selected");
		}
	});
	var eche = $(".cod_container div:nth-child(n)");
	for(var j=1; j<=60; j++){	
		for(var i=1; i<=eche.length; i++){
			var codigo = $(".cod_container div:nth-child("+i+")").attr("id");			
			var code = $(".puestos_container div:nth-child("+j+")").attr("id");
			if(codigo == code){
				var insert = $(".cod_container div:nth-child("+i+")").html();
				$(".puestos_container div:nth-child("+j+")").append(insert);
			}
		}
	}
	$("#valido").change(function(){
		$("#image").toggle();
		$("#save_profile").toggle();
	});
	$("#image").change(function(){
			$('#show_preview').click();
			
	});
	 $('#form1').ajaxForm({ 
				target: '.preview', 
				success: function() { 
					$('.preview').fadeIn('slow'); 
				} 
    		});
	$("#login_form").validate();		
	
});


</script>

</body>
</html>

