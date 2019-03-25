<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
<title>SL BRASIL - EDI</title>
<link rel="stylesheet" href="/res/css/style.css" />
<link rel="stylesheet" href="res/css/bootstrap.min.css" />
<link rel="stylesheet" href="/res/css/AdminLTE.min.css" />
 <!-- Font Awesome -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 <!-- Ionicons -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body id="index">
	<div id="header">
		<img id="logo-topo" src="/res/images/logo.jpg" />
	</div>
	<div id="welcome">
		<h1>Bem-vindo à SL Brasil - EDI</h1>
	</div>
	<div id="div-file">
		<form id="form-file" enctype="multipart/form-data" method="post"
			action="/report">
			
			<div class="row">
			<div class="col-md-6 col-md-offset-3 center">
				<div class="btn-container">
					<!--the three icons: default, ok file (img), error file (not an img)-->
					<h1 class="txtupload"><i class="fa fa-file-text-o"></i></h1>
					<h1 class="txtupload ok"><i class="fa fa-check"></i></h1>
					<h1 class="txtupload stop"><i class="fa fa-times"></i></h1>
					<!--this field changes dinamically displaying the filename we are trying to upload-->
					<p id="namefile"></p>
					<!--our custom btn which which stays under the actual one-->
					<button type="button" id="btnup" class="btn btn-info btn-lg">Selecionar arquivo...</button>
					<!--this is the actual file input, is set with opacity=0 beacause we wanna see our custom one-->
					<input type="file" value="" name="fileup" id="fileup" accept=".txt">
				</div>
			</div>
		</div>
			<!--additional fields-->
		<div class="row">			
			<div class="col-md-12" style="text-align: center">
				<!--the defauld disabled btn and the actual one shown only if the three fields are valid-->
				<input type="submit" value="Gerar Relatório" class="btn btn-success" id="submitbtn">
				<button type="button" class="btn btn-success" disabled="disabled" id="fakebtn"><i class="fa fa-ban"></i> &nbsp; Gerar Relatório</button>
			</div>
		</div>			
			

		</form>
	</div>


</body>
<script type="text/javascript" src="/res/javascript/funcoes.js"></script>


<!-- jQuery 2.2.3 -->
<script src="/res/javascript/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/res/javascript/bootstrap.min.js"></script>

<script type="text/javascript">

$('#fileup').change(function(){
	//here we take the file extension and set an array of valid extensions
	    var res=$('#fileup').val();
	    var arr = res.split("\\");
	    var filename=arr.slice(-1)[0];
	    filextension=filename.split(".");
	    filext="."+filextension.slice(-1)[0];
	    valid=[".txt"];
	//if file is not valid we show the error icon, the red alert, and hide the submit button
	    if (valid.indexOf(filext.toLowerCase())==-1){
	        $( ".txtupload" ).hide("slow");
	        $( ".txtupload.ok" ).hide("slow");
	        $( ".txtupload.stop" ).show("slow");
	      
	        $('#namefile').css({"color":"red","font-weight":700});
	        $('#namefile').html("File "+filename+" is not  pic!");
	        
	        $( "#submitbtn" ).hide();
	        $( "#fakebtn" ).show();
	    }else{
	        //if file is valid we show the green alert and show the valid submit
	        $( ".txtupload" ).hide("slow");
	        $( ".txtupload.stop" ).hide("slow");
	        $( ".txtupload.ok" ).show("slow");
	      
	        $('#namefile').css({"color":"green","font-weight":700});
	        $('#namefile').html(filename);
	      
	        $( "#submitbtn" ).show();
	        $( "#fakebtn" ).hide();
	        
	        $("#btnup").removeClass('btn-info');
	        $("#btnup").addClass('btn-warning');
	        $("#btnup").html("Selecionar outro arquivo...");
	        
	    }
	});

</script>
</html>