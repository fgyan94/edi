<?php
namespace edi;

class QTY extends SEGMENT {
    
    public function __construct() {
        $data = array(
            "ID" => array(
                "ID"
            ),
            "QUALIFIER" => array(
                "ID",
                "QUANTITY",
                "MEASUREUNIT"
            )
        );
        
        $this->setData($data);
    }
    
    public function start($index, $line, $className, $classIgnore = array(), $hasStart = true, $seg_number = 0) {
    	array_unshift($classIgnore, "RFF");
    	parent::start($index, $line, 'DTM', $classIgnore, false);
    	
    	array_shift($classIgnore);
    	parent::start($index, $line, 'RFF', $classIgnore);
    }
}
?>