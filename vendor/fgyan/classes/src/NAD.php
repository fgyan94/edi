<?php

namespace edi;

class NAD extends SEGMENT {
	
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
			"PARTY_QUALIFIER" => array(
				"QUALIFIER"
			),
			"PARTY_IDENT" => array(
				"ID",
				"QUALIFIER",
				"CODED"
			),
			"NAME_ADDRESS" => array(
				"NAME_ADD"
			),
			"PARTY_NAME" => array(
				"NAME"
			),
			"STREET" => array(
				"STREET_AND_NUMBER"
			),
			"CITY" => array(
				"NAME"
			),
			"STATE" => array(
				"NAME"
			),
			"POSTCODE" => array(
				"ID"
			),
			"COUNTRY" => array(
				"CODED"
			)
		);

		parent::setData($data);
	}
	
	public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(),
	    $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
	    
        if($_STRATEGY === EDI::_DELJIT_STRATEGY_) {
 
            array_unshift($_CLASS_IGNORE, "CTA");
            parent::start($_INDEX, $_LINE, 'RFF', $_CLASS_IGNORE);
            
        } else {
            
            if($_SEG_NUMBER == 'SEG02') {
    			array_unshift($_CLASS_IGNORE, "CTA");			
    			parent::start($_INDEX, $_LINE, 'LOC', $_CLASS_IGNORE, false);
    			
    			array_shift($_CLASS_IGNORE);
    			parent::start($_INDEX, $_LINE, 'CTA', $_CLASS_IGNORE);
    			
    		} else if($_SEG_NUMBER == 'SEG07') {
    			array_unshift($_CLASS_IGNORE, 'TDT');
    			array_unshift($_CLASS_IGNORE, 'CTA');
    			array_unshift($_CLASS_IGNORE, 'DOC');
    			array_unshift($_CLASS_IGNORE, 'RFF');
    			array_unshift($_CLASS_IGNORE, 'FTX');
    			
    			parent::start($_INDEX, $_LINE, 'LOC', $_CLASS_IGNORE, false);
    			
    			array_shift($_CLASS_IGNORE);
    			parent::start($_INDEX, $_LINE, 'FTX', $_CLASS_IGNORE, false);
    			
    			array_shift($_CLASS_IGNORE);
    			parent::start($_INDEX, $_LINE, 'RFF', $_CLASS_IGNORE);
    			
    			array_shift($_CLASS_IGNORE);
    			parent::start($_INDEX, $_LINE, 'DOC', $_CLASS_IGNORE);
    			
    			array_shift($_CLASS_IGNORE);
    			parent::start($_INDEX, $_LINE, 'CTA', $_CLASS_IGNORE);
    			
    			array_shift($_CLASS_IGNORE);
    			parent::start($_INDEX, $_LINE, 'TDT', $_CLASS_IGNORE);
    			
    		} else if($_SEG_NUMBER == 'SEG22') {
    			array_unshift($_CLASS_IGNORE, 'TDT');
    			array_unshift($_CLASS_IGNORE, 'SCC');
    			array_unshift($_CLASS_IGNORE, 'QTY');
    			array_unshift($_CLASS_IGNORE, 'CTA');
    			array_unshift($_CLASS_IGNORE, 'DOC');
    			array_unshift($_CLASS_IGNORE, 'FTX');
    			
    			parent::start($_INDEX, $_LINE, 'LOC', $_CLASS_IGNORE, false);
    			
    			array_shift($_CLASS_IGNORE);
    			parent::start($_INDEX, $_LINE, 'FTX', $_CLASS_IGNORE, false);
    			
    			array_shift($_CLASS_IGNORE);
    			parent::start($_INDEX, $_LINE, 'DOC', $_CLASS_IGNORE);
    			
    			array_shift($_CLASS_IGNORE);
    			parent::start($_INDEX, $_LINE, 'CTA', $_CLASS_IGNORE);
    			
    			array_shift($_CLASS_IGNORE);
    			parent::start($_INDEX, $_LINE, 'QTY', $_CLASS_IGNORE);
    			
    			array_shift($_CLASS_IGNORE);
    			parent::start($_INDEX, $_LINE, 'SCC', $_CLASS_IGNORE);
    			
    			array_shift($_CLASS_IGNORE);
    			parent::start($_INDEX, $_LINE, 'TDT', $_CLASS_IGNORE);
    			
    		}
        }
	}
}

