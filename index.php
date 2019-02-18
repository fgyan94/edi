<?php
// error_reporting(0);
// ini_set(“display_errors”, 0);

session_start();

require_once ("vendor/autoload.php");

use \Slim\Slim;
use edi\Page;
use edi\DELFOR;
use edi\EXCEL;
use edi\DELJIT;

$app = new Slim;

$app->config ( 'debug', true );

$app->get('/', function() {
    $page = new Page();
    $page->setTPL('index');
});

$app->get('/report', function() {
    if(!isset($_FILES['tmp_name'])) {
        header('Location: /');
        exit;
    }
});

$app->get('/export', function() {
    if(!isset($_FILES['tmp_name'])) {
        header('Location: /');
        exit;
    }
    
});

$app->post('/report', function() {
    if(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION) !== 'txt') {
        echo "<script>
                    alert('Arquivo inválido! Apenas arquivos texto (.TXT) são permitidos');
                    window.location = '/';
            </script>";
        exit;
    }
    
    $file = $_FILES['file'];
    $tmpFile = $file['tmp_name'];
    $filename = $file['name'];
    $destination = $_SERVER['DOCUMENT_ROOT'] . "/upfiles/delfor/" . $filename;
    
    move_uploaded_file($tmpFile, $destination);
    
    $delforFile = $destination;
    
    $delfor = new DELFOR($delforFile);
    
//     $delfor = new DELJIT($delforFile);
    
    $delfor->startExplode();
    
    $page = new Page();
    $page->setTPL('report', array(
            "delfor" => $delfor,
            "filename"=>base64_encode($filename)
          )	
    );
    
});

$app->get('/export/:filename', function($filename) {
    $excel = new EXCEL();
    $excel->export($filename);
});


$app->run();

?>