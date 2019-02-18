<?php
namespace edi;

class PAC extends SEGMENT {
    private $_QTY;
    
    public function __construct() {
        $data = array(
            "ID" => array(
            	"ID"
            ),
        	"NUMBER_OF_PACKS" => array(
        		"NUMBER"
        	),
        	"DETAILS" => array(
        		"LEVEL",
        		"RELATED_INFO",
        		"TERMS_COND"
        	),
        	"TYPE" => array(
        		"ID",
        		"QUALIFIER",
        		"AGENCY",
        		"TYPE_OF"
        	),
        	"TYPE_ID" => array(
        		"DESCR_TYPE",
        		"TYPE_OF",
        		"NUMBER"
        	),
        	"RETURN_PACK_DETAILS" =>array(
        		"PAY_RESP",
        		"LOAD_CONT"
        	)
        );
        
        parent::setData($data);
    }
    
    public function start($index, $line, $className, $classIgnore = array(), $hasStart = true, $seg_number = 0) {
    	array_unshift($classIgnore, 'PCI');
    	array_unshift($classIgnore, 'DTM');
    	array_unshift($classIgnore, 'QTY');
    	
    	parent::start($index, $line, 'MEA', $classIgnore, false);
    	
    	array_shift($classIgnore);
    	parent::start($index, $line, 'QTY', $classIgnore, false);
    	
    	array_shift($classIgnore);
    	parent::start($index, $line, 'DTM', $classIgnore, false);
    	
    	array_shift($classIgnore);
    	parent::start($index, $line, 'PCI', $classIgnore);
    	
    }
}