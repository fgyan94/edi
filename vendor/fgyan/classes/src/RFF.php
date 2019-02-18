<?php

namespace edi;

class RFF extends SEGMENT {
	
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
			"REF" => array(
				"QUALIFIER",
				"NUMBER",
				"LINE",
				"VERSION"
			)
		);
		
		parent::setData($data);
	}
	
	public function start($index, $line, $className, $classIgnore = array(), $hasStart = true, $seg_number = 0) {
		parent::start($index, $line, "DTM", $classIgnore, false);
	}
}

