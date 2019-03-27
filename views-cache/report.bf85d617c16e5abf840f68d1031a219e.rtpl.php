<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
<title>SL BRASIL - DELFOR/EDI</title>
<link rel="stylesheet" href="/res/css/style.css" />
</head>
<body id="report">
	<div id="header">
		<div id="menu-topo">
			<a href="/"> <img alt="Home" src="/res/images/home.png"> <span>página inicial</span>
			</a> <a href="/export/<?php echo htmlspecialchars( $filename, ENT_COMPAT, 'UTF-8', FALSE ); ?>"> <img alt="Export to Excel"
				src="/res/images/export-excel.png"> <span>exportar para excel</span>
			</a>
		</div>
		<a href="/"><img id="logo-topo" src="/res/images/logo.jpg" /></a>
	</div>
	<div id="content">
		<div id="title">
			<hgroup>
				<h1>PROGRAMAÇÃO DE PEÇA/MATERIAL - ANALÍTICO</h1>
				<h3>GMB - GENERAL MOTORS DO BRASIL S/A</h3>
				<?php if( $delfor->getStrategy() == 0 ){ ?>
				<h2 style='color: #DDD; text-shadow: 0px 0px 15px #f66b29'>DELFOR</h2>
				<?php }else{ ?>
				<h2 style='color: #DDD; text-shadow: 0px 0px 15px #628f35'>DELJIT</h2>
				<?php } ?>
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
			<div id="item">
				<table id="tb-delfor-data-item">
				<tr>
					<td colspan="4" class="header">Código do Item:</td>
				</tr>
				<tr>
					<td colspan="4" class="cell"><strong><?php echo htmlspecialchars( $value1->getPartNumber(), ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></td>
				</tr>
				<tr>
					<td class="header">Planta:</td>
					<td class="cell"><?php echo htmlspecialchars( $delfor->getPlanta(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
					<td class="header">Doca:</td>
					<td class="cell"><?php echo htmlspecialchars( $value1->getDoca(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				</tr>
				<tr>
					<td class="header">Location:</td>
					<td class="cell"><?php echo htmlspecialchars( $value1->getMaterialHandling(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
					<td class="header">Pedido:</td>
					<td class="cell"><?php echo htmlspecialchars( $value1->getPedido(), ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
				</tr>				
				</table>
				<table id="tb-delfor-item">
					<caption id="caption-crono">CRONOGRAMA</caption>
					<thead>
						<?php if( $delfor->getStrategy() === 0 ){ ?>
						<tr>
							<td>TIPO DE</td>
							<td>FREQUÊNCIA</td>
							<td>DATA</td>
							<td>QUANTIDADE</td>
							<td>QTDE ACUMULADA</td>
						</tr>
						<?php }else{ ?>
						<tr>
							<td>DATA</td>
							<td>QUANTIDADE</td>
						</tr>
						<?php } ?>
					</thead>
					<tbody>
						<?php $counter2=-1; $newvar2=$value1->getLineItemValues()["QUANTITY"]; if( isset($newvar2) && ( is_array($newvar2) || $newvar2 instanceof Traversable ) && sizeof($newvar2) ) foreach( $newvar2 as $key2 => $value2 ){ $counter2++; ?>
						<tr>
							<?php if( $delfor->getStrategy() === 0 ){ ?>
								<td><?php echo htmlspecialchars( $value1->getLineItemValues()["TYPE"]["$counter2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
								<td><?php echo htmlspecialchars( $value1->getLineItemValues()["FREQUENCY"]["$counter2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
							 <?php } ?>
							 
							<td><?php echo htmlspecialchars( $value1->getLineItemValues()["DATE_TIME"]["$counter2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
							<td><?php echo htmlspecialchars( $value1->getLineItemValues()["QUANTITY"]["$counter2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
							
							<?php if( $delfor->getStrategy() === 0 ){ ?>
								<td><?php echo htmlspecialchars( $value1->getLineItemValues()["ACCUMULATED"]["$counter2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
							<?php } ?>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<?php } ?>
		</div>
	</div>

</body>
</html>