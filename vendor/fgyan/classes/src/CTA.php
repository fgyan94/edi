<?php

namespace edi;

class CTA extends SEGMENT {
	
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
			"CONTACT_FUNCTION" => array(
				"CODE"
			),
			"DEPART_OR_EMPLOY" => array(
				"ID",
				"NAME"
			)
		);
		parent::setData($data);
	}
	
	public function start($index, $line, $className, $classIgnore = array(), $hasStart = true, $seg_number = 0) {
		parent::start($index, $line, 'COM', $classIgnore, false);
	}
}

