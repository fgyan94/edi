<?php

namespace edi;

class FTX extends SEGMENT {
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
			"TEXT_SUB_QUALIFIER" => array(
				"TEXT"
			),
			"TEXT_REF" => array(
				"FREE_TEXT",
				"QUALIFIER",
				"CODED"
			),
			"TEXT_LITERAL" => array(
				"FREE_TEXT"
			),
			"LANGUAGE" => array(
				"CODED"
			)
		);
		
		parent::setData($data);
	}
}

