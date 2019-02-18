<?php
namespace edi;

class DELJIT extends DELFOR {
    
    public function __construct($_FILENAME) {
        parent::__construct($_FILENAME);
        parent::setStrategy(EDI::_DELJIT_STRATEGY_);
    }
    
    protected function setData() {
        $_SEG = array(
            "ID_DOC_MSG" => '',
            "FUNCTION_MSG" => '',
            "GENERATE_DATE" => '',
            "INI_HORIZ" => '',
            "END_HORIZ" => '',
            "EMITENTE" => '',
            "STATUS_INDIC" => '',
            "LIN" => array()
        );
        
        parent::setSEG($_SEG);
        
        
        
        $this->runArray($this->get(), 'UNH');
        $this->setID_DOC_MSG($GLOBALS['SEG']);
        
        $this->runArray($this->get(), 'BGM');
        $this->setFUNCTION_MSG($GLOBALS['SEG']->getValues());
        
        $this->runArray($this->get(), 'UNB');
        $this->setEMITENTE($GLOBALS['SEG']->getValues());
        
        $this->runArray($this->get(), 'SEQ');
        $this->setSTATUS_INDIC($GLOBALS['SEG']);
    }
    
    private function setSTATUS_INDIC($_SEQ) {
        $_VALUES = $_SEQ->getValues();
        $_PROCESS_INDIC = $_VALUES['STATUS_INDIC']['CODE'];
        $this->_SEG['STATUS_INDIC'] = (int)$_PROCESS_INDIC;
    }
    
    public function getStatusIndic() {
        return $this->_SEG['STATUS_INDIC']; 
    }
    
    protected function setID_DOC_MSG($_UNH) {
        parent::setID_DOC_MSG($_UNH);
        
        for($i = 0; $i < count($_UNH->getSubSeg()); $i++) {
            $_SEQ = $_UNH->getSubSeg()[$i];
            if($_SEQ instanceof SEQ) {
                for($j = 0; $j < count($_SEQ->getSubSeg()); $j++){
                    $_LIN = $_SEQ->getSubSeg()[$j];
                    if($_LIN instanceof LIN){
                        $this->pushLIN($_LIN);
                    }
                }
            }
        }
    }
}

