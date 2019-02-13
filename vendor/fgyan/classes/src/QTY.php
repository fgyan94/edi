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
    
    public function start($index, $line, $className, $classIgnore, $hasStart = true) {
        parent::start($index, $line, 'DTM', 'QTY', false);
    }

}

?>