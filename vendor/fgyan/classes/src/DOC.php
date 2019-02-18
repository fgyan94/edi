<?php

namespace edi;

class DOC extends SEGMENT {
	
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
		);
		
		parent::setData($data);
	}
	
	public function start($index, $line, $className, $classIgnore = array(), $hasStart = true, $seg_number = 0) {
		parent::start($index, $line, 'DTM', $classIgnore, false);
	}
}

