<?php
namespace edi;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class EXCEL {
    
	private $_DELFOR;
	private $_TAGS;
    private $_EXCEL;
    private $_ACTIVE_SHEET;
    private $_ROW = 20;
    
    public function __construct() {
    	$reader = IOFactory::createReader('Xlsx');
    	$this->_EXCEL = $reader->load($_SERVER['DOCUMENT_ROOT']."/res/templates/edi.xlsx");
    }
    
    public function export($file) {
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/upfiles/delfor/" . base64_decode($file);
        
        if(file_exists($filename)) {
            
            $this->_DELFOR = new DELFOR($filename);
            $this->_DELFOR->startExplode();
            
            $this->_TAGS = $this->_DELFOR->get()['LIN'];
            
            $this->_EXCEL->setActiveSheetIndex(0);
            
            $this->setNumSheets();
            
            
            for($i = 0; $i < count($this->_TAGS); $i++) {
            	$_LIN = $this->_TAGS[$i];
            	$this->_ACTIVE_SHEET = $this->_EXCEL->setActiveSheetIndex($i);
            	
            	if($_LIN instanceof LIN) {
            		
            		if($i == 0) {
            			$this->designLinks(true, false);
            		}
            		else if($i == (count($this->_TAGS) - 1)) {
            			$this->designLinks(false, true);
            		}
            		else {
            			$this->designLinks();
            		}
            			
            		$_ITEMS = $_LIN->getLineItemValues();
            		
            		for($j = 0; $j < $_LIN->getCount(); $j++, $this->_ROW++) {
            			$this->_ACTIVE_SHEET
            			->mergeCells("B$this->_ROW:D$this->_ROW")
            			->setCellValue("B$this->_ROW", $_ITEMS['TYPE'][$j])
            			
            			->mergeCells("E$this->_ROW:G$this->_ROW")
            			->setCellValue("E$this->_ROW", $_ITEMS['FREQUENCY'][$j])
            			
            			->mergeCells("H$this->_ROW:J$this->_ROW")
            			->setCellValue("H$this->_ROW", $_ITEMS['DATE_TIME'][$j])
            			
            			->mergeCells("K$this->_ROW:M$this->_ROW")
            			->setCellValue("K$this->_ROW", $_ITEMS['QUANTITY'][$j])
            			
            			->mergeCells("N$this->_ROW:P$this->_ROW")
            			->setCellValue("N$this->_ROW", $_ITEMS['ACCUMULATED'][$j]);
            		}
            		
            		$this->_ROW = 20;
            	}
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
    
    private function setNumSheets() {
    	$this->_ACTIVE_SHEET = $this->_EXCEL->getActiveSheet();
    	
    	for($i = 0; $i < count($this->_TAGS); $i++) {
    		$_LIN = $this->_TAGS[$i];
    		
    		if($_LIN instanceof LIN) {
    			$_LIN->startFormat();
	    		$_NEW_SHEET = $this->_ACTIVE_SHEET->copy();
	    		$_NEW_SHEET->setTitle($_LIN->getPartNumber());
	    		
	    		$this->_EXCEL->addSheet($_NEW_SHEET, $i);
    		}
    	}
    	
    	$this->_EXCEL->removeSheetByIndex($this->_EXCEL->getSheetCount() - 1);    	
    	$this->_EXCEL->setActiveSheetIndex(0);
    	
    }
    
    private function designLinks($next = true, $prev = true) {
    	if($next) {
    		$_NEXT = new Drawing();
    		$_NEXT->setPath($_SERVER['DOCUMENT_ROOT']."/res/images/next.png");
    		$_NEXT->setOffsetX(15);
    		$_NEXT->setOffsetY(15);
    		$_NEXT->setCoordinates("O9");
    		$_NEXT->setWorksheet($this->_EXCEL->getActiveSheet());
    		$this->_EXCEL->getActiveSheet()->setCellValue("O9", "next");
    	} 
    	
    	if($prev) {
    		$_PREVIOUS = new Drawing();
    		$_PREVIOUS->setPath($_SERVER['DOCUMENT_ROOT']."/res/images/previous.png");
    		$_PREVIOUS->setOffsetX(15);
    		$_PREVIOUS->setOffsetY(15);
    		$_PREVIOUS->setCoordinates("A9");
    		$_PREVIOUS->setWorksheet($this->_EXCEL->getActiveSheet());
    		$this->_EXCEL->getActiveSheet()->setCellValue("A9", "previous");
    	}
    }
}

