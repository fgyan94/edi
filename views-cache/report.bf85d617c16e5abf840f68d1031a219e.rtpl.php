<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8"/>
<title>SL BRASIL - DELFOR/EDI</title>
<link rel="stylesheet" href="/res/css/style.css" />
</head>
<body>
<div id="header">
	<div id="menu-topo">
		<a href="/">
			<img alt="Home" src="/res/images/home.png">
			<span>home</span>
		</a>
		
		<a href="/export/<?php echo htmlspecialchars( $filename, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
			<img alt="Export to Excel" src="/res/images/export-excel.png">
			<span>export to excel</span>
		</a>
	</div>
	<img id="logo-topo" src="/res/images/logo.jpg"/>
</div>
<div id="content">
	<div id="title">
		<hgroup>
		<h1>PROGRAMAÇÃO DE PEÇA/MATERIAL - ANALÍTICO</h1>
		<h3>GMB - GENERAL MOTORS DO BRASIL S/A</h3>
		</hgroup>
	</div>
	<div id="delfor-data">
		<table id="tb-delfor-data">
			<caption>INFORMAÇÕES DA PROGRAMAÇÃO</caption>
			<tr>
				<td class="header">Data da Geração:</td>
				<td class="cell"><?php echo htmlspecialchars( $delfor->getGenerateDate(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				<td class="header"></td>
				<td class="cell"></td>
			</tr>
			<tr>
				<td class="header">Documento/Mensagem:</td>
				<td class="cell"><?php echo htmlspecialchars( $delfor->getDocID(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				<td class="header">Emitente:</td>
				<td class="cell"><?php echo htmlspecialchars( $delfor->getEmitente(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
			</tr>
			<tr>
				<td class="header">Função da Mensagem:</td>
				<td class="cell"><?php echo htmlspecialchars( $delfor->getMsgFunc(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				<?php if( $delfor->getStrategy() == 0 ){ ?>
				<td class="header">Indicador de Processamento:</td>
				<td class="cell"><?php echo htmlspecialchars( $delfor->getProcessIndic(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				<?php }else{ ?>
				<td class="header">Indicador de Status:</td>
				<td class="cell"><?php echo htmlspecialchars( $delfor->getStatusIndic(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				<?php } ?>				
			</tr>
			<tr>
				<td class="header">Início do Horizonte:</td>
				<td class="cell"><?php echo htmlspecialchars( $delfor->getIniHoriz(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				<td class="header">Fim do Horizonte:</td>
				<td class="cell"><?php echo htmlspecialchars( $delfor->getEndHoriz(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
			</tr>
			<tr>
				<td class="header">Programa Atual:</td>
				<td class="cell"><?php echo htmlspecialchars( $delfor->getGenerateDate(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				<td class="header"></td>
				<td class="cell"></td>
			</tr>
		</table>
			<?php $counter1=-1; $newvar1=$delfor->getLIN(); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
			<?php echo htmlspecialchars( $value1->startFormat(), ENT_COMPAT, 'UTF-8', FALSE ); ?>
		<table id="tb-delfor-item">
			<caption id="caption-item">Código do Item: </caption>
			<caption id="caption-item-number"><?php echo htmlspecialchars( $value1->getPartNumber(), ENT_COMPAT, 'UTF-8', FALSE ); ?></caption>
			<caption id="caption-crono">CRONOGRAMA</caption>
			<thead>
			<tr>
				<td>TIPO DE</td>
				<td>FREQUÊNCIA</td>
				<td>DATA-HORA</td>
				<td>QUANTIDADE</td>
				<td>QTDE ACUMULADA</td>			
			</tr>
			</thead>
			<tbody>
			<?php $counter2=-1; $newvar2=$value1->getLineItemValues()["TYPE"]; if( isset($newvar2) && ( is_array($newvar2) || $newvar2 instanceof Traversable ) && sizeof($newvar2) ) foreach( $newvar2 as $key2 => $value2 ){ $counter2++; ?>
			<tr>
			
				<td><?php echo htmlspecialchars( $value1->getLineItemValues()["TYPE"]["$counter2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				
				<td><?php echo htmlspecialchars( $value1->getLineItemValues()["FREQUENCY"]["$counter2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				
				<td><?php echo htmlspecialchars( $value1->getLineItemValues()["DATE_TIME"]["$counter2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
	
				<td><?php echo htmlspecialchars( $value1->getLineItemValues()["QUANTITY"]["$counter2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				
				<td><?php echo htmlspecialchars( $value1->getLineItemValues()["ACCUMULATED"]["$counter2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				
			</tr>
			<?php } ?>
			</tbody>
		</table>
			<?php } ?>
	</div>
</div>

</body>
</html>