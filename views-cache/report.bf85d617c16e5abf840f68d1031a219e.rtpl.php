<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8"/>
<title>SL BRASIL - DELFOR/EDI</title>
<link rel="stylesheet" href="/res/css/style.css" />
</head>
<body>
<div id="header">
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
			
		</table>
			<?php $counter1=-1;  if( isset($tag["LIN"]) && ( is_array($tag["LIN"]) || $tag["LIN"] instanceof Traversable ) && sizeof($tag["LIN"]) ) foreach( $tag["LIN"] as $key1 => $value1 ){ $counter1++; ?>
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