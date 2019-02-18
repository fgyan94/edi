<?php

namespace edi;

class DELFOR {
    private $_FILE_1;
    private $_FILE_2;
    private $_LINES_1 = [];
    private $_LINES_2 = [];
    private $_FINAL_LINES = [];
    private $_COLUMN = [];
    private $_BUILD = [];
    private $_CLASS_IGNORE = array();
    private $_STRATEGY = EDI::_DELFOR_STRATEGY_;
    private $_MESSAGE;
    
    protected $_SEG = array();
    
    public function __construct($_FILENAME) {
        $this->_FILE_1 = fopen($_FILENAME, 'r');
        $this->_FILE_2 = fopen($_FILENAME, 'r');
    }
    
    public function startExplode() {
        $this->lineExplode();
        $this->compareLines();
        $this->build();
        $this->setData();
    }
    
    private function lineExplode() {
        $this->_LINES_1 = explode("'", fgets($this->_FILE_1));
        
        for($i = 0; !feof($this->_FILE_2); $i++) {
            $this->_LINES_2[$i] = fgets($this->_FILE_2);
        }
        
        
    }
    
    private function compareLines() {
        if(count($this->_LINES_1) > count($this->_LINES_2))
            $this->_FINAL_LINES = $this->_LINES_1;
        else
            $this->_FINAL_LINES = $this->_LINES_2;
            
    }
    
    protected function build() {
        if($this->_STRATEGY === EDI::_DELFOR_STRATEGY_)
            $this->_CLASS_IGNORE = array("BGM", "DTM", "FTX", "RFF", "NAD", "TDT", "GIS", "UNT", "UNZ");
        else
            $this->_CLASS_IGNORE = array("BGM", "DTM", "FTX", "RFF", "NAD", "SEQ", "UNT", "UNZ");
        
        for ($i = 0; $i < count($this->_FINAL_LINES); $i++) {
            $_VALUE = $this->_FINAL_LINES[$i];
            $_SUBS = substr($_VALUE, 0, 3);
            
            if('UNB' === $_SUBS) {
                $_SUBS = "\\edi\\".$_SUBS;
                $_SEG = new $_SUBS();
                $_SEG->dismember($_VALUE);
                $_SEG->start($i, $this->_FINAL_LINES, 'UNH', $this->_CLASS_IGNORE, true, 0, $this->_STRATEGY);
                $i = $_SEG->getIndex();
                
                $this->_MESSAGE = $_SEG;
            }
        }
    }    
    
    public function get() {
    	return $this->_MESSAGE;
    }
    
    public function add(SEGMENT $_SEG, $_KEY){
    	if(!isset($this->_SUB_SEG[$_KEY]) || !is_array($this->_SUB_SEG[$_KEY]))
    		$this->_SUB_SEG[$_KEY] = array();
    		
    		array_push($this->_SUB_SEG[$_KEY], $_SEG);
    }
    
    protected function setData() {
        $this->_SEG = array(
            "ID_DOC_MSG" => '',
            "FUNCTION_MSG" => '',
            "GENERATE_DATE" => '',
            "INI_HORIZ" => '',
            "END_HORIZ" => '',
            "EMITENTE" => '',
            "PROCESS_INDIC" => '',
            "LIN" => array()
        );
        
    	$this->runArray($this->get(), 'UNH');
    	$this->setID_DOC_MSG($GLOBALS['SEG']);
    	   
    	$this->runArray($this->get(), 'BGM');
    	$this->setFUNCTION_MSG($GLOBALS['SEG']->getValues());
    	
    	$this->runArray($this->get(), 'UNB');
    	$this->setEMITENTE($GLOBALS['SEG']->getValues());
    	
    	$this->runArray($this->get(), 'GIS');
    	$this->setPROCESS_INDIC($GLOBALS['SEG']);
    	
    	$this->runArray($this->get(), 'DTM');
    	$this->setDocDates($GLOBALS['SEG']);
    
    }
    
    protected function runArray($_ARRAY, $_WHAT) {
    	if($_ARRAY instanceof SEGMENT) {
    		if($_ARRAY->getValues()['ID']['ID'] == $_WHAT) {
    			$GLOBALS['SEG'] = $_ARRAY;
    		} else {
    			$this->runArray($_ARRAY->getSubSeg(), $_WHAT);
    		}
    	} else if(is_array($_ARRAY)){
    		for($i = 0; $i < count($_ARRAY); $i++){
    			$this->runArray($_ARRAY[$i], $_WHAT);
    		}
    	}
    }
    
    protected function setSEG($_SEG = array()) {
        $this->_SEG = $_SEG;
    }
    
    protected function setID_DOC_MSG($_UNH) {
        $_VALUES = $_UNH->getValues();
        $_ID_DOC_MSG = $_VALUES['MESSAGE_REF_NUM']['ID'];
        $this->_SEG['ID_DOC_MSG'] = $_ID_DOC_MSG;
        
        for($i = 0; $i < count($_UNH->getSubSeg()); $i++) {
            $_DTM = $_UNH->getSubSeg()[$i];
            if($_DTM instanceof DTM){
                $this->setDocDates($_DTM);
            }
        }
    }
    
    protected function setFUNCTION_MSG($_BGM) {
        $_FUNCTION_MSG = $_BGM['MESSAGE_FUNCTION']['CODE'];
        $this->_SEG['FUNCTION_MSG'] = $_FUNCTION_MSG;
    }
    
    protected function setDocDates(DTM $_DTM) {
    	$_VALUES = $_DTM->getValues();
    	
    	if($_VALUES['DTM_PERIOD']['QUALIFIER'] == 137)
    		$this->setGENERATE_DATE($_DTM->convert());
    	else if($_VALUES['DTM_PERIOD']['QUALIFIER'] == 158)
    	    $this->setINI_HORIZ($_DTM->convert());
    	else if($_VALUES['DTM_PERIOD']['QUALIFIER'] == 159)
    	    $this->setEND_HORIZ($_DTM->convert());
    				
    }
    
    protected function setGENERATE_DATE($_DTM) {
        $this->_SEG['GENERATE_DATE'] = $_DTM;
    }
    
    protected function setINI_HORIZ($_DTM) {
        $this->_SEG['INI_HORIZ'] = $_DTM;
    }
    
    protected function setEND_HORIZ($_DTM) {
        $this->_SEG['END_HORIZ'] = $_DTM;
    }
    
    protected function setEMITENTE($_UNB) {
        $_EMITENTE = $_UNB['INTERCHANGE_SENDER']['ID'];
        $this->_SEG['EMITENTE'] = $_EMITENTE;
    }
    
    protected function setPROCESS_INDIC($_GIS) {
        $_VALUES = $_GIS->getValues();
        $_PROCESS_INDIC = $_VALUES['PROCESS_IDENT']['ID'];
        $this->_SEG['PROCESS_INDIC'] = $_PROCESS_INDIC;
        
        for($i = 0; $i < count($_GIS->getSubSeg()); $i++) {
            $_LIN = $_GIS->getSubSeg()[$i];
            if($_LIN instanceof LIN){
                $this->pushLIN($_LIN);
            }
        }
    }
    
    protected function pushLIN($_LIN) {
    	array_push($this->_SEG["LIN"], $_LIN);
    }
    
    public function getGenerateDate() {
    	return $this->_SEG['GENERATE_DATE'];
    }
    
    public function getDocID() {
    	return $this->_SEG['ID_DOC_MSG'];
    }
    
    public function getIniHoriz() {
    	return $this->_SEG['INI_HORIZ'];
    }
    
    public function getEndHoriz() {
    	return $this->_SEG['END_HORIZ'];
    }
    
    public function getMsgFunc() {
        return $this->formatMsgFunc();
    }
    
    private function formatMsgFunc() {
        $_RET = (int)$this->_SEG['FUNCTION_MSG'];
        
        switch ($_RET) {
            case(2):
                $_RET .= ' - Complemento';
                break;
            case(4):
                $_RET .= ' - Alteração';
                break;
            case(5):
                $_RET .= ' - Substituição';
                break;
            case(9):
                $_RET .= ' - Original';
                break;
            case(11):
                $_RET .= ' - Resposta';
            default:
                break;
        }
        
        return $_RET;
    }
    
    public function getEmitente() {
    	return $this->_SEG['EMITENTE'];
    }
    
    public function getProcessIndic() {
    	return $this->_SEG['PROCESS_INDIC'];    	
    }
    
    public function getLIN() {
    	return $this->_SEG['LIN'];
    }
    
    public function __destruct() {
        fclose($this->_FILE_1);
        fclose($this->_FILE_2);
        
        unset($this->_LINES_1);
        unset($this->_LINES_2);
        unset($this->_FINAL_LINES);
        unset($this->_COLUMN);
        unset($this->file);
    }
    
    protected function setStrategy($_STRATEGY = EDI::_DELFOR_STRATEGY_) {
        $this->_STRATEGY = $_STRATEGY;
    }
    
    public function getStrategy() {
        return $this->_STRATEGY;
    }
}

?>