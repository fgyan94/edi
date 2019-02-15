<?php
namespace edi;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class EXCEL {
    
    private $_EXCEL;
    
    public function __construct() {
        $this->_EXCEL = new Spreadsheet();
    }
    
    public function export($file) {
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/upfiles/delfor" . $file;
        
        if(file_exists($filename)) {
            
            $delfor = new DELFOR($filename);
            $delfor->startExplode();
            
            $tags = $delfor->get()['LIN'];
            
            
            $this->_EXCEL->setActiveSheetIndex(0);
            for($i = 0; $i < $tags; $i++) {
                
            }
            
            
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header('Content-Disposition: attachment;filename="Resumo EDI.xlsx"');
          header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
          header("Cache-Control: post-check=0, pre-check=0", false);
          header("Pragma: no-cache");
          
          $writer = IOFactory::createWriter($this->_EXCEL, 'Xlsx');
          $writer->save('php://output');
          exit;
        }
    }
}

