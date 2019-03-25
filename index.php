<?php
// error_reporting ( 0 );
// ini_set ( “display_errors”, 0 );

session_start();

require_once ("vendor/autoload.php");

use Slim\Slim;
use edi\Page;
use edi\EXCEL;
use edi\EDI;
use edi\EDI_FILE;

global $PATH_DIR_UPLOAD;
global $PATH_DIR_DOWNLOAD;
global $TEMPLATE;

$PATH_DIR_DOWNLOAD = $_SERVER ['DOCUMENT_ROOT'] . "/downfiles";
$PATH_DIR_UPLOAD = $_SERVER ['DOCUMENT_ROOT'] . "/upfiles";
$TEMPLATE = $_SERVER ['DOCUMENT_ROOT'] . "/res/templates";


function clearDIR() {
	deleteFiles($GLOBALS['PATH_DIR_DOWNLOAD']);
	deleteFiles($GLOBALS['PATH_DIR_UPLOAD']);
}
	
function deleteFiles($_DIR) {
	$_FILES = scandir($_DIR);
	
	foreach ($_FILES as $_FILE) {
		if(!in_array($_FILE, array(".", ".."))) {
			unlink($_DIR.DIRECTORY_SEPARATOR.$_FILE);		
		}
	}
}

$app = new Slim();

$app->config ( 'debug', true );

$app->get ( '/', function () {
	clearDIR();
	
	$page = new Page ();
	$page->setTPL ( 'index' );
} );

$app->get ( '/report', function () {
	if (! isset ( $_FILES ['tmp_name'] )) {
		header ( 'Location: /' );
		exit ();
	}
} );

$app->get ( '/export', function () {
	if (! isset ( $_FILES ['tmp_name'] )) {
		header ( 'Location: /' );
		exit ();
	}
} );

$app->post ( '/report', function () {
	if (pathinfo ( $_FILES ['file'] ['name'], PATHINFO_EXTENSION ) !== 'txt') {
		echo "<script>
                    alert('Arquivo inválido! Apenas arquivos texto (.TXT) são permitidos');
                    window.location = '/';
            </script>";
		exit ();
	}

	$_EDI_FILE = new EDI_FILE ( $_FILES ['file'] );
	$_EDI = new EDI ( $_EDI_FILE->getFile () );
	$_EDI->startExplode ();
	$page = new Page ();
	$page->setTPL ( 'report', array (
			"delfor" => $_EDI->getInstance (),
			"filename" => EXCEL::export ( $_EDI )
	) );
} );

$app->get ( '/export/:filename', function ($_FILENAME) use ($PATH_DIR_DOWNLOAD) {
	$_FILE_PATH = $PATH_DIR_DOWNLOAD . DIRECTORY_SEPARATOR . $_FILENAME;

	header ( 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
	header ( 'Content-Disposition: attachment;filename="' . $_FILENAME . '"' );
	header ( "Cache-Control: no-store, no-cache, must-revalidate, max-age=0" );
	header ( "Cache-Control: post-check=0, pre-check=0", false );
	header ( "Pragma: no-cache" );

	readfile ( $_FILE_PATH );
} );

$app->run ();
?>