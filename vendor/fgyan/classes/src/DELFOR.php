<?php

namespace edi;

class DELFOR {
    private $file;
    private $lines_1 = [];
    private $lines_2 = [];
    private $final_lines = [];
    private $column = [];
    private $build = [];
    
    private $_MESSAGE;
    
    public function __construct($filename) {
        $this->file = fopen($filename, 'r');
    }
    
    public function startExplode() {
        $this->lineExplode();
        $this->compareLines();
        $this->build();
        $this->setData();
    }
    
    private function lineExplode() {
        $this->lines_1 = explode("'", fgets($this->file));
        
        for($i = 0; !feof($this->file); $i++) {
            $this->lines_2[$i] = fgets($this->file);
        }
    }
    
    private function compareLines() {
        if(count($this->lines_1) > count($this->lines_2))
            $this->final_lines = $this->lines_1;
        else
            $this->final_lines = $this->lines_2;
            
    }
    
    private function build() {    	
        for ($i = 0; $i < count($this->final_lines); $i++) {
            $value = $this->final_lines[$i];
            $subs = substr($value, 0, 3);
            
            if('UNB' === $subs) {
                $subs = "\\edi\\".$subs;
                $_SEG = new $subs();
                $_SEG->dismember($value);
                $_SEG->start($i, $this->final_lines, 'UNH');
                $i = $_SEG->getIndex();
                
//                 array_push($this->_TAGS['LIN'], $this->_SEG);
                $this->_MESSAGE = $_SEG;
            }
        }
    }    
    
    public function get() {
    	return $this->_MESSAGE;
    }
    
    public function add(SEGMENT $_SEG, $key){
    	if(!isset($this->_SUB_SEG[$key]) || !is_array($this->_SUB_SEG[$key]))
    		$this->_SUB_SEG[$key] = array();
    		
    		array_push($this->_SUB_SEG[$key], $_SEG);
    }
    
    private $_SEG = array(
    		"ID_DOC_MSG",
    		"FUNCTION_MSG",
    		"GENERATE_DATE",
    		"INI_HORIZ",
    		"END_HORIZ",
    		"EMITENTE",
    		"PROCESS_INDIC",
    		"LIN" => array()
    );
    
    private function setData() {
//     	if($_SEG instanceof UNB) {
//     		setEMITENTE($_SEG->getValues());
//     	} else if($_SEG instanceof UNH) {
//     		$this->setFUNCTION_MSG($_SEG->getValues());
//     	} else if($_SEG instanceof DTM) {
//     		$this->setDocDates($_SEG);
//     	} else if($_SEG instanceof GIS) {
//     		$this->setPROCESS_INDIC($_SEG->getValues());
//     	} else if($_SEG instanceof LIN) {
//     		$this->pushLIN($_SEG);
//     	}
    	
//     	var_dump($this->get()->getValues());
//     	exit;
    	$_VALUES = $this->runArray($this->get(), 'GIS');
    	
    	var_dump($_VALUES);
//     	$this->setID_DOC_MSG($_VALUES);
    }
    
    private function runArray($array, $what) {
    	if($array instanceof SEGMENT) {
    		if($array->getValues()['ID']['ID'] == $what) {
    			return $array;
    		} else {
    			$this->runArray($array->getSubSeg(), $what);
    		}
    	} else if(is_array($array)){
    		for($i = 0; $i < count($array); $i++){
    			$this->runArray($array[$i], $what);
    		}
    	}
    }
    
    private function setID_DOC_MSG($var) {
    	var_dump($var);
    	exit;
    	$this->_SEG['ID_DOC_MSG'] = $var;
    }
    
    private function setFUNCTION_MSG($var) {
    	$this->_SEG['FUNCTION_MSG'] = $var;
    }
    
    private function setDocDates(DTM $_DTM) {
    	$_VALUES = $_DTM->getValues();
    	
    	if($_VALUES['DTM_PERIOD']['QUALIFIER'] == 137)
    		$this->setGENERATE_DATE($_DTM->convert());
    	else if($_VALUES['DTM_PERIOD']['QUALIFIER'] == 158)
    		$this->setGENERATE_DATE($_DTM->convert());
    	else if($_VALUES['DTM_PERIOD']['QUALIFIER'] == 159)
    		$this->setGENERATE_DATE($_DTM->convert());
    				
    }
    
    private function setGENERATE_DATE($var) {
    	$this->_SEG['GENERATE_DATE'] = $var;
    }
    
    private function setINI_HORIZ($var) {
    	$this->_SEG['INI_HORIZ'] = $var;
    }
    
    private function setEND_HORIZ($var) {
    	$this->_SEG['END_HORIZ'] = $var;
    }
    
    private function setEMITENTE($_UNB) {
    	$var = $_UNB['INTERCHANGE_SENDER']['ID'];
    	$this->_SEG['EMITENTE'] = $var;
    }
    
    private function setPROCESS_INDIC($_GIS) {
    	$var = $_GIS['PROCESS_IDENT']['ID'];
    	$this->_SEG['PROCESS_INDIC'] = $var;
    }
    
    private function pushLIN($_LIN) {
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
    	return $this->_SEG['FUNCTION_MSG'];
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
        fclose($this->file);
        
        unset($this->lines_1);
        unset($this->lines_2);
        unset($this->final_lines);
        unset($this->column);
        unset($this->file);
    }
}

?>