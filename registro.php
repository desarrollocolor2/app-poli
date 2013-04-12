<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>


<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<!--<script src="http://cdn.jquerytools.org/1.2.7/tiny/jquery.tools.min.js"></script>-->
<script src="jquery.form.js" type="text/javascript"></script>
<script src="jquery.validate.js" type="text/javascript"></script>


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

<div id="fb-root"></div>



<!--<fb:login-button autologoutlink="true" perms="email,user_birthday,status_update,publish_stream,user_about_me"></fb:login-button>-->
<fb:login-button login_text="Insertar datos" class="login_fb" ></fb:login-button>
 <div id="login"></div>
 <div id="name" data-value="0"></div>
<form id="login_form" action="send.php" name="form" enctype="multipart/form-data" method="post" >
	<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
<script type="text/javascript">
          function showRecaptcha() {
            Recaptcha.create("6Lcfyt8SAAAAAHQEWRd_wMqJG-bGdgypv_f0y7OB", 'captchadiv', {
                tabindex: 1,
                theme: "red",
                callback: Recaptcha.focus_response_field
            });
          }
        </script>
  <label>
  nombre </label>
  <input name="nombre" type="text" id="nombre" required="required">
 
  <br> 
  <label>
  documento</label>
  <input name="documento" type="text" id="documento" required="required">
  
  <br> 
  <label>
  ciudad</label>
  <input name="ciudad" type="text" id="ciudad" required="required">
  
  <br> 
  <label>
  telefono</label>
  <input name="telefono" type="text" id="telefono" required="required">
  
  <br>   
  <label>
  email</label> 
  <input name="email" type="email" id="email" required="required">
  
  <br>
  <label>
  estudio </label>
  <input name="estudio" type="text" id="estudio" required="required">
 
  <br>
  <label>area interes</label>
  <select id="program_principal" name="modalidad">
    <option value="1">Presencial</option>
    <option value="2">Virtual</option>
    </select>
    <select id="program_type" name="tipo_programa">
    <option value="1">Pregrado</option>
    <option value="2">Postgrado</option>
    </select>
    <select id="program" name="programa">
   </select>
  
  <br>
  <label>subir foto</label>
  <input name="foto" type="text" id="foto" required="required">
  <input type="button" class="select_picture" value="Cargar Foto" /> 
  <div class="profile_pic"></div>
  
  <br>

  <label>puesto </label> 
  <input name="puesto" type="text" id="puesto" required="required">
  <br />
  <div id="captchadiv"></div>
  <br />
  <input id="action1" type="submit" value="Subir">
</form>
<form style="display:none;" id="form1" name="form1" action="uploader.php" enctype="multipart/form-data" method="post">
	<input name="image" type="file" id="image"> 
    <input name="valido" type="checkbox" id="valido" />
    <div class="preview"></div>
    <input id="save_profile" type="button" value="guardar" />
    <input id="show_preview" type="submit" value="ver">
</form>
<div class="resultado_consulta"></div>
<div class="puestos_container">
	<?php for($i=1; $i<=60;$i++){ 
            //if($i==$f['codigo'])
    ?>
            <div class="puesto" id="p<?php echo $i?>"></div>
    <?php } ?>
    <div class="clear"></div>
</div>
<script type="text/javascript">
	window.fbAsyncInit = function() {
		FB.init({appId: '239728666173010', status: true, cookie: true, xfbml: true});

		/* All the events registered */
		FB.Event.subscribe('auth.login', function(response) {
			// do something with response
			login();
		});
		FB.Event.subscribe('auth.logout', function(response) {
			// do something with response
			logout();
		});

		FB.getLoginStatus(function(response) {
			if (response.session) {
				// logged in and connected user, someone you know
				//login();
			}
		});
	};
	(function() {
		var e = document.createElement('script');
		e.type = 'text/javascript';
		e.src = document.location.protocol +
			'//connect.facebook.net/en_US/all.js';
		e.async = true;
		document.getElementById('fb-root').appendChild(e);
	}());

	function login(){
		FB.api('/me', function(response) {
			
			
			 $(".cargar_fb_datos").click();
			 $(".select_picture").hide();
		});
		
	}
	function logout(){
		document.getElementById('login').style.display = "none";
	}

	//stream publish method
	function streamPublish(name, description, hrefTitle, hrefLink, userPrompt){
		FB.ui(
		{
			method: 'stream.publish',
			message: '',
			attachment: {
				name: name,
				caption: '',
				description: (description),
				href: hrefLink
			},
			action_links: [
				{ text: hrefTitle, href: hrefLink }
			],
			user_prompt_message: userPrompt
		},
		function(response) {

		});

	}
	function showStream(){
		FB.api('/me', function(response) {
			//console.log(response.id);
			streamPublish(response.name, 'Thinkdiff.net contains geeky stuff', 'hrefTitle', 'http://thinkdiff.net', "Share thinkdiff.net");
		});
	}

	function share(){
		var share = {
			method: 'stream.share',
			u: 'http://thinkdiff.net/'
		};

		FB.ui(share, function(response) { console.log(response); });
	}

	function graphStreamPublish(){
		var body = 'Reading New Graph api & Javascript Base FBConnect Tutorial from Thinkdiff.net';
		FB.api('/me/feed', 'post', { message: body }, function(response) {
			if (!response || response.error) {
				alert('Error occured');
			} else {
				alert('Post ID: ' + response.id);
			}
		});
	}

	function fqlQuery(){
		FB.api('/me', function(response) {
			 var query = FB.Data.query('select name, hometown_location, sex, pic_square, email from user where uid={0}', response.id);
			 query.wait(function(rows) {
			   var fb_email = rows[0].email;
			   var fb_city = rows[0].hometown_location;
			   var fb_city_name;
			   if(fb_email==null)
			   {
				   fb_email='';
			   }
			   if(fb_city==null){
			       fb_city_name='';
			   }
			   else{
				   fb_city_name = rows[0].hometown_location['name'];
			   }
				 /* document.getElementById('name').innerHTML =
				 '<div class="fb_profile">' + rows[0].name + '</div>' +
				 '<img class="fb_picture" src="' + rows[0].pic_square + '" alt="" />' +
				 '<div class="fb_city"' + fb_city_name + '</div>' +
				 '<div class="fb_email">' + fb_email + '</div>';*/
				 $("#nombre").val(rows[0].name);
				 $("#email").val(fb_email);
				 $("#ciudad").val(fb_city_name);
				 $("#foto").val(rows[0].pic_square);
				 $(".profile_pic").html('<img class="fb_picture" src="' + rows[0].pic_square + '" alt="" />');
			     $(".select_picture").hide();
			 });
		});
	}

	function setStatus(){
		status1 = document.getElementById('status').value;
		FB.api(
		  {
			method: 'status.set',
			status: status1
		  },
		  function(response) {
			if (response == 0){
				alert('Your facebook status not updated. Give Status Update Permission.');
			}
			else{
				alert('Your facebook status updated');
			}
		  }
		);
	}

</script>
<script type="text/javascript">


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
	$("#save_profile").click(function(){
		var tmp_img = $(".tmp_image").attr('src');
		var prof_img = tmp_img.replace('tmp/','fotos/');
		//var img_name = prof_img.replace('fotos/','');
		$(".profile_pic").html('<img class="profile_pic" src="'+prof_img+'"/>');
		$("#foto").val(prof_img);
		$('#show_preview').click();
	});
	 $('#form1').ajaxForm({ 
				target: '.preview', 
				success: function() { 
					$('.preview').fadeIn('slow'); 
				} 
    		});
	 $('#login_form').ajaxForm({ 
				target: '.resultado_consulta', 
				success: function() { 
					var vaciado = $('.resultado_consulta').html(); 
					if(vaciado == ''){
						window.location.reload();
					}
				} 
    		});		
	$("#login_form").validate();
	$(".select_picture").click(function(){
		$("#form1").show();
	});
	
	setTimeout(function(){		
		fqlQuery();
		showRecaptcha();
	},1000);
});


/*function setsubmit()
	{
	  document.form1.target='_self';
	  document.form1.action='archivo_que_procesa_tu_form';
	  document.form1.submit(); 
	   
	}*/
var value_type;
var value_principal;
$("#program_principal").change(function () {
	//var str = "";
	$("#program_principal option:selected").each(function () {
	//str += $(this).text() + " ";
		value_principal = $(this).val();
	});
	$("#program_type").change(function () {
		//var str = "";
		$("#program_type option:selected").each(function () {
		//str += $(this).text() + " ";
			value_type = $(this).val();
		});
		//$(".program_val").text(str);
		if(value_principal==1 && value_type == 1){
			$("#program").html('<optgroup label="Profesional"><option>Administración de empresas</option><option>Ingenieria de Sistemas</option></optgroup><optgroup label="Tecnológico"><option>Tecnología en Redes</option></optgroup>');
		}
		else if(value_principal==1 && value_type == 2){
			$("#program").html('<optgroup label="Especialización"><option>Sistemas de información</option><option>Gerencia de Proyectos</option></optgroup><optgroup label="Maestria"><option>Finanzas y Relaciones internacionales</option></optgroup>');
		}
		else if(value_principal==2 && value_type == 1){
			$("#program").html('<optgroup label="Especialización"><option>Maestria en la salud</option><option>Gerencia de Proyectos</option></optgroup><optgroup label="Maestria"><option>Finanzas y Relaciones internacionales</option></optgroup>');
		}
		else{
			$("#program").html('<optgroup label="Especialización"><option>Seguridad Industrial</option><option>Gerencia de Proyectos</option></optgroup><optgroup label="Maestria"><option>Finanzas y Relaciones internacionales</option></optgroup>');
		}
	}).change();
}).change();	

</script>

</body>
</html>

