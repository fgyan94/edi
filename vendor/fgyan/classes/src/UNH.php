<?php

namespace edi;

class UNH extends SEGMENT{
	
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
			"MESSAGE_REF_NUM" => array(
				"ID"
			),
			"MESSAGE_IDENT" => array(
				"TYPE",
				"VERSION",
				"RELEASE",
				"AGENCY",
				"ASSIGN_CODE"
			),
			"ACC_REF" => array(
				"CODE"
			),
			"STATUS_TRANS" => array(
				"SEQ",
				"FIRST_LAST"
			)
		);
		
		$this->setData($data);
	}
	
	public function start($index, $line, $className, $classIgnore = array(), $hasStart = true, $seg_number = 0) {
		
		parent::start($index, $line, 'BGM', $classIgnore, false);
		
		array_shift($classIgnore);
		parent::start($index, $line, 'DTM', $classIgnore, false);
		
		array_shift($classIgnore);
		parent::start($index, $line, 'FTX', $classIgnore, false);
		
		array_shift($classIgnore);
		parent::start($index, $line, 'RFF', $classIgnore);
		
		array_shift($classIgnore);
		parent::start($index, $line, 'NAD', $classIgnore, true, 'SEG02');
		
		array_shift($classIgnore);
		parent::start($index, $line, 'TDT', $classIgnore);
		
		array_shift($classIgnore);
		parent::start($index, $line, 'GIS', $classIgnore);
		
		array_shift($classIgnore);
		parent::start($index, $line, 'UNT', $classIgnore, false);
	}
}