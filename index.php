<?php
// error_reporting(0);
// ini_set(“display_errors”, 0);

session_start();

require_once ("vendor/autoload.php");
// use edi\Page;
use \Slim\Slim;
use edi\Page;
use edi\DELFOR;

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

$app->post('/report', function() {
    $file = $_FILES['file'];
    $tmpFile = $file['tmp_name'];
    $filename = $file['name'];
    $destination = $_SERVER['DOCUMENT_ROOT'] . "/upfiles/" . $filename;
    
    move_uploaded_file($tmpFile, $destination);
    
    $delforFile = $destination;
    
    $delfor = new DELFOR($delforFile);
    
    $delfor->startExplode();
    
    $page = new Page();
    $page->setTPL('report', array(
            "tag" => $delfor->get()));
});

$app->run();

?>