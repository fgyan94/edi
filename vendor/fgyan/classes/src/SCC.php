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
    
    public function start($index, $line, $className, $classIgnore = array(), $hasStart = true, $seg_number = 0) {
    	parent::start($index, $line, 'QTY', $classIgnore);
    }
}

