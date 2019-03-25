<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
<title>SL BRASIL - EDI</title>
<link rel="stylesheet" href="/res/css/style.css" />
<script type="text/javascript" src="/res/javascript/funcoes.js"></script>
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
			<input id="file" name="file" type="file" accept=".txt"
				onchange="change()" ondragover="dragOver()"
				ondragleave="dragLeave()" ondrop="dragLeave()" />
			<div class="overlay-layer" id="file-label">Selecionar arquivo</div>
			<button id="generate" type="submit" disabled="disabled">
				Gerar Relatório
			</button>
		</form>
	</div>


</body>
</html>