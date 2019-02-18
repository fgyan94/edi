<?php
namespace edi;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

class EXCEL {
    
	private $_DELFOR;
	private $_TAGS;
    private $_EXCEL;
    private $_ROW = 20;
    
    public function __construct() {
    	$reader = IOFactory::createReader('Xlsx');
    	$this->_EXCEL = $reader->load($_SERVER['DOCUMENT_ROOT']."/res/templates/edi.Xlsx");
    }
    
    public function export($file) {
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/upfiles/delfor/" . base64_decode($file);
        
        if(file_exists($filename)) {
            
            $this->_DELFOR = new DELFOR($filename);
            $this->_DELFOR->startExplode();
            
            $this->_TAGS = $this->_DELFOR->getLIN();
            
            $this->_EXCEL->setActiveSheetIndex(0);
            
            $this->loadInfo();
            
            $this->setNumSheets();
            
            
            for($i = 0; $i < count($this->_TAGS); $i++) {
            	$_LIN = $this->_TAGS[$i];
            	$this->_EXCEL->setActiveSheetIndex($i);
            	
            	if($_LIN instanceof LIN) {
            		
            		if($i == 0) {
            			$this->defineLinks(true, false);
            		}
            		else if($i == (count($this->_TAGS) - 1)) {
            			$this->defineLinks(false);
            		}
            		else {
            			$this->defineLinks();
            		}
            			
            		$_ITEMS = $_LIN->getLineItemValues();
            		
            		$_STYLE = array(
            				"alignment" => array(
            						'horizontal' => Alignment::HORIZONTAL_LEFT,
            						'vertical' => Alignment::VERTICAL_CENTER
            				)
            		);
            		
            		$this->_EXCEL->getActiveSheet()
            		->mergeCells("E16:G16")
            		->setCellValue("E16", $_LIN->getPartNumber())
            		->getStyle("E16")
            		->applyFromArray($_STYLE);
            		
            		for($j = 0; $j < $_LIN->getCount(); $j++, $this->_ROW++) {   
            			$_STYLE['alignment']['horizontal'] = Alignment::HORIZONTAL_CENTER;
            			            			
            			$this->setCellValue("B", "D", $_ITEMS['TYPE'], $_STYLE, $j);
            			$this->setCellValue("E", "G", $_ITEMS['FREQUENCY'], $_STYLE, $j);
            			$this->setCellValue("H", "J", $_ITEMS['DATE_TIME'], $_STYLE, $j);
            			$this->setCellValue("K", "M", $_ITEMS['QUANTITY'], $_STYLE, $j);
            			$this->setCellValue("N", "P", $_ITEMS['ACCUMULATED'], $_STYLE, $j);
            		}
            		
            		$this->_ROW = 20;
            	}
            }
            
            $this->_EXCEL->setActiveSheetIndex(0);
            $this->_EXCEL->getProperties()->setCreator('Yan Gonçalves')
            ->setLastModifiedBy('Yan Gonçalves')
            ->setTitle('RESUMO EDI - SL BRASIL')
            ->setSubject('DELFOR')
            ->setDescription('DOCUMENTO DELFOR - GM')
            ->setCategory('DELFOR FILE');
          
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
    
    private function setCellValue($rangeStart, $rangeEnd, $array, $style, $index) {
    	$this->_EXCEL->getActiveSheet()
    	->mergeCells("$rangeStart$this->_ROW:$rangeEnd$this->_ROW")
    	->setCellValue("$rangeStart$this->_ROW", $array[$index])
    	->getStyle("$rangeStart$this->_ROW")
    	->applyFromArray($style);
    }
    
    private function loadInfo() {
        $_SHEET = $this->_EXCEL->getActiveSheet();
        $_DELFOR = $this->_DELFOR;
        
        $_SHEET->setCellValue('E7', $_DELFOR->getGenerateDate());
        $_SHEET->setCellValue('E8', $_DELFOR->getDocID());
        $_SHEET->setCellValue('E9', $_DELFOR->getMsgFunc());
        $_SHEET->setCellValue('E10', $_DELFOR->getIniHoriz());
        $_SHEET->setCellValue('E11', $_DELFOR->getGenerateDate());
        $_SHEET->setCellValue('L8', $_DELFOR->getEmitente());
        $_SHEET->setCellValue('L9', (int)$_DELFOR->getProcessIndic());
        $_SHEET->setCellValue('L10', $_DELFOR->getEndHoriz());
    }
    
    private function setNumSheets() {    	
    	for($i = 0; $i < count($this->_TAGS); $i++) {
    		
    		$_LIN = $this->_TAGS[$i];
    		
    		if($_LIN instanceof LIN) {
    			$_LIN->startFormat();
    			$_NEW_SHEET = $this->_EXCEL->getSheet(0)->copy();
	    		$_NEW_SHEET->setTitle($_LIN->getPartNumber());
	    		$_NEW_SHEET->setShowGridlines(false);
	    		
	    		$this->_EXCEL->addSheet($_NEW_SHEET);
    		}
    	}
    	
    	$this->_EXCEL->removeSheetByIndex(0);
    	
    	
    }
    
    private function defineLinks($next = true, $prev = true) {    	
    	if($next) {
    		$_IMAGE_NEXT = imagecreatefrompng($_SERVER['DOCUMENT_ROOT']."/res/images/next.png");
    		$this->designLinks($_IMAGE_NEXT, "O9", "next");
    	} 
    	
    	if($prev) {
    		$_IMAGE_PREVIOUS = imagecreatefrompng($_SERVER['DOCUMENT_ROOT']."/res/images/previous.png");
    		$this->designLinks($_IMAGE_PREVIOUS, "A9", "previous", false);
    	}
    }
    
    private function designLinks($_IMAGE, $_COORD, $_TEXT, $_isNext = true) {
    	$_LINK = new MemoryDrawing();
    	$_LINK->setMimeType(MemoryDrawing::MIMETYPE_PNG);
    	$_LINK->setRenderingFunction(MemoryDrawing::RENDERING_PNG);
    	$_LINK->setImageResource($_IMAGE);
    	$_LINK->setOffsetX(15);
    	$_LINK->setOffsetY(15);
    	$_LINK->setCoordinates($_COORD);
    	
    	if($_isNext)
    		$_ACTION = $this->_EXCEL->getActiveSheetIndex() + 1;
    	else
    		$_ACTION = $this->_EXCEL->getActiveSheetIndex() - 1;
    	
    	$_LINK_SHEET = $this->_EXCEL->getSheet($_ACTION)->getTitle();
    	$_URL = "#$_LINK_SHEET!A1";
    	
    	$_HYPERLINK = $this->_EXCEL->getActiveSheet()->getCell($_COORD)->getHyperlink();
    	
    	$_HYPERLINK->setUrl($_URL);
    	$this->_EXCEL->getActiveSheet()->setCellValue($_COORD, $_TEXT);
    	
    	$_LINK->setHyperlink($_HYPERLINK);
    	$_LINK->setWorksheet($this->_EXCEL->getActiveSheet());
    }
}

