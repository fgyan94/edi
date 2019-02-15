<?php
namespace edi;

class LIN extends SEGMENT {
    private $_PIA;
    private $_PAC;
    
    private $_ITEM_VALUES = array(
        "PART_NUMBER" => "",
        "TYPE" => array(),
        "FREQUENCY" => array(),
        "DATE_TIME" => array(),
        "QUANTITY" => array(),
        "ACCUMULATED" => array()
    );
    
    public function __construct() {
        $data = array(
            "ID" => array(
                "ID"
            ),
            "NUMBER" => array(
                "NUMBER"
            ),
            "ACTION" => array(
                "CODE"
            ),
            "PARTNUMBER" => array(
                "CODE",
                "TYPE"
            )
        );
        
        $this->setData($data);
    }
    
    public function setPIA(PIA $_PIA) {
        $this->PIA = $_PIA;
    }
    
    public function start($index, $line, $className, $classIgnore, $hasStart = true) {
        parent::start($index, $line, 'QTY', 'SCC');
        parent::start($index, $line, 'SCC', 'PAC');
    }
    
    public function startFormat() {
        $this->setGenerationDate();
//         $this->setMessageCode();
//         $this->setMessageFunction();
//         $this->setIniHorizonte();
//         $this->setFimHorizonte();
//         $this->setCurrentProgram();
//         $this->setEmitente();
//         $this->setProcessingIndicator();
        
        
        $this->setPartNumber();
        $this->setType();
        $this->setFrequency();
        $this->setDateTime();
        $this->setQuantity();
        $this->setAccumulated();
    }
    
    private function setGenerationDate() {
        
    }
    
    private function setPartNumber() {
        $this->_ITEM_VALUES['PART_NUMBER'] = $this->getValues()['PARTNUMBER']['CODE'];
    }
    
    private function setType() {
        foreach ($this->getSubSeg() as $key => $value) {
            if($value instanceof SCC) {
                if($value->getValues()['STATUS_INDIC']['NUMBER'] == 4) {
                    
                    for($i = 0; $i < count($value->getSubSeg()); $i++) {
                        array_push($this->_ITEM_VALUES['TYPE'], $value->getValues()['STATUS_INDIC']['NUMBER']);
                    }
                }
            }
        }
    }
    
    private function setFrequency() {
        foreach ($this->getSubSeg() as $key => $value) {
            if($value instanceof SCC) {
                if($value->getValues()['STATUS_INDIC']['NUMBER'] == 4) {
                    
                    for($i = 0; $i < count($value->getSubSeg()); $i++) {
                        if(isset($value->getValues()['PATTERN_DESCR']['FREQUENCY']))
                            array_push($this->_ITEM_VALUES['FREQUENCY'], $value->getValues()['PATTERN_DESCR']['FREQUENCY']);
                    }
                }
            }
        }        
    }
    
    private function setDateTime() {
        foreach ($this->getSubSeg() as $key => $value) {
            if($value instanceof SCC) {
                if($value->getValues()['STATUS_INDIC']['NUMBER'] == 4) {
                
                    foreach ($value->getSubSeg() as $sub_key => $sub_value) {
                        if($sub_value instanceof QTY) {
                            
                            foreach ($sub_value->getSubSeg() as $sub_key_2 => $sub_value_2) {
                                if ($sub_value_2 instanceof DTM) {
                                    $timestamp = strtotime($sub_value_2->getValues()['DTM_PERIOD']['DATE_TIME']);
                                    $date = date('d/m/Y', $timestamp);
                                    
                                    array_push($this->_ITEM_VALUES['DATE_TIME'], $date);
                                }   
                            }
                        }
                    }
                }
            }
        }
    }
    
    private function setQuantity() {
        foreach ($this->getSubSeg() as $key => $value) {
            if($value instanceof SCC) {
                if($value->getValues()['STATUS_INDIC']['NUMBER'] == 4) {
                    
                    foreach ($value->getSubSeg() as $sub_key => $sub_value) {
                        if($sub_value instanceof QTY) {
                            array_push($this->_ITEM_VALUES['QUANTITY'], $sub_value->getValues()['QUALIFIER']['QUANTITY']);
                        }
                    }
                }
            }
        }
    }
    
    private function setAccumulated() {
        $_TEMP_ACCUMULATED = 0;
        
        foreach ($this->getSubSeg() as $key => $value) {
            if($value instanceof QTY) {
                $_TEMP_ACCUMULATED = $value->getValues()['QUALIFIER']['QUANTITY'];
                break;
            }
        }
        
        
        for($i = 0; $i < count($this->_ITEM_VALUES['QUANTITY']); $i++) {
            $_TEMP_ACCUMULATED += $this->_ITEM_VALUES['QUANTITY'][$i];
            array_push($this->_ITEM_VALUES['ACCUMULATED'], $_TEMP_ACCUMULATED);
        }
        
    }
    
    public function getPartNumber() {
        return $this->_ITEM_VALUES['PART_NUMBER'];
    }
    
    public function getLineItemValues() {
        return $this->_ITEM_VALUES;
    }
    
    public function getCount() {
    	return count($this->_ITEM_VALUES['QUANTITY']);
    }
}

?>