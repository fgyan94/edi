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
	
	public function start($index, $line, $className, $classIgnore = array(), $hasStart = true, $seg_number = 0) {
		if($seg_number == 'SEG02') {
			array_unshift($classIgnore, "CTA");			
			parent::start($index, $line, 'RFF', $classIgnore);
			
			array_shift($classIgnore);
			parent::start($index, $line, 'CTA', $classIgnore);
			
		} else if($seg_number == 'SEG07') {
			array_unshift($classIgnore, 'TDT');
			array_unshift($classIgnore, 'CTA');
			array_unshift($classIgnore, 'DOC');
			array_unshift($classIgnore, 'RFF');
			array_unshift($classIgnore, 'FTX');
			
			parent::start($index, $line, 'LOC', $classIgnore, false);
			
			array_shift($classIgnore);
			parent::start($index, $line, 'FTX', $classIgnore, false);
			
			array_shift($classIgnore);
			parent::start($index, $line, 'RFF', $classIgnore);
			
			array_shift($classIgnore);
			parent::start($index, $line, 'DOC', $classIgnore);
			
			array_shift($classIgnore);
			parent::start($index, $line, 'CTA', $classIgnore);
			
			array_shift($classIgnore);
			parent::start($index, $line, 'TDT', $classIgnore);
			
		} else if($seg_number == 'SEG22') {
			array_unshift($classIgnore, 'TDT');
			array_unshift($classIgnore, 'SCC');
			array_unshift($classIgnore, 'QTY');
			array_unshift($classIgnore, 'CTA');
			array_unshift($classIgnore, 'DOC');
			array_unshift($classIgnore, 'FTX');
			
			parent::start($index, $line, 'LOC', $classIgnore, false);
			
			array_shift($classIgnore);
			parent::start($index, $line, 'FTX', $classIgnore, false);
			
			array_shift($classIgnore);
			parent::start($index, $line, 'DOC', $classIgnore);
			
			array_shift($classIgnore);
			parent::start($index, $line, 'CTA', $classIgnore);
			
			array_shift($classIgnore);
			parent::start($index, $line, 'QTY', $classIgnore);
			
			array_shift($classIgnore);
			parent::start($index, $line, 'SCC', $classIgnore);
			
			array_shift($classIgnore);
			parent::start($index, $line, 'TDT', $classIgnore);
			
		}
		
	}
}

