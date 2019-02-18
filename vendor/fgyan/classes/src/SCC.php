<?php
namespace edi;

class SCC extends SEGMENT {
    
    public function __construct() {
        $data = array(
            "ID" => array(
                "ID"
            ),
            "STATUS_INDIC" => array(
                "NUMBER"
            ),
            "REQUIREMENTS" => array(
                "CODE"
            ),
            "PATTERN_DESCR" => array(
                "FREQUENCY",
                "DESPATCH"
            )
        );
        
        $this->setData($data);
    }
    
    public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(),
        $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
        
        parent::start($_INDEX, $_LINE, 'QTY', $_CLASS_IGNORE);
    }
}

