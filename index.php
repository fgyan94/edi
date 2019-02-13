<?php
// error_reporting(0);
// ini_set(“display_errors”, 0);

session_start();

require_once ("vendor/autoload.php");
// use edi\Page;
use Slim\Slim;
use edi\Page;
use \edi\Delfor;

$app = new Slim;

$app->config ( 'debug', true );

$app->get('/', function() {
    $page = new Page();
    $page->setTPL('index');
    
});

$app->post('/report', function() {
    
//     if(!isset($_POST['file']))
//         header('Location: /');
    
//     var_dump($_POST);
//     exit;
        
//     $filename = $_POST['file'];
    
//     $delfor = new Delfor($filename);
    
//     $delfor->startExplode();
    
    $page = new Page();
    $page->setTPL('report');
    
});

$app->run();

?>