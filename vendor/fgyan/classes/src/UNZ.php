<?php

namespace edi;

class UNZ extends SEGMENT {
	
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
			"COUNT" => array(
				"NUM"
			),
			"REF" => array(
				"NUM"
			)
		);
		
		parent::setData($data);
	}
}

