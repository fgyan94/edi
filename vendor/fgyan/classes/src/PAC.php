<?php
namespace edi;

class PAC extends SEGMENT {
    private $_QTY;
    
    public function __construct() {
        $data = array(
            "ID",
            "LEVEL",
            "INFO",
            "TERMS",
            "LIST_QUALIFIER",
            "AGENCY",
            "TYPE",
        );
        
        parent::setData($data);
    }
}