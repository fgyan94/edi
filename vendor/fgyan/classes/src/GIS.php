<?php

namespace edi;

class GIS extends SEGMENT {
	
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
			"PROCESS_IDENT" => array(
				"ID",
				"QUALIFIER",
				"AGENCY",
				"TYPE_ID"
			)
		);
		
		parent::setData($data);
	}
	
	public function start($index, $line, $className, $classIgnore = array(), $hasStart = true, $seg_number = 0) {
		array_unshift($classIgnore, 'LIN');
		parent::start($index, $line, 'NAD', $classIgnore, $hasStart, 'SEG07');
		
		array_shift($classIgnore);
		parent::start($index, $line, 'LIN', $classIgnore);
	}
}

