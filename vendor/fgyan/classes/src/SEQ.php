<?php
namespace edi;

class SEQ extends SEGMENT {
    
    public function __construct() {
        $data =  array(
            "ID" => array(
                "ID"
            ),
            "STATUS_INDIC" => array(
                "CODE"
            ),
            "INFO" => array(
                "NUMBER",
                "NUMBER_SOURCE",
                "QUALIFIER",
                "AGENCY"
            )
        );
        
        parent::setData($data);
    }
    
    public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(),
                    $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
        
        array_unshift($_CLASS_IGNORE, 'LIN');
        parent::start($_INDEX, $_LINE, 'PAC', $_CLASS_IGNORE, true, $_SEG_NUMBER, EDI::_DELJIT_STRATEGY_);
        
        parent::start($_INDEX, $_LINE, 'LIN', $_CLASS_IGNORE, true, $_SEG_NUMBER, EDI::_DELJIT_STRATEGY_);
    }
}

