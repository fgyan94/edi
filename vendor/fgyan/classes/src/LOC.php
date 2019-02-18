<?php

namespace edi;

class LOC extends SEGMENT {
	
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
			"PLACE" => array(
				"QUALIFIER"
			),
			"LOCATION" => array(
				"ID",
				"QUALIFIER",
				"AGENCY",
				"DESCR"
			),
			"RELATED_LOC_ONE" => array(
				"ID",
				"QUALIFIER",
				"AGENCY",
				"DESCR_ONE"
			),
			"RELATED_LOC_TWO" => array(
				"ID",
				"QUALIFIER",
				"AGENCY",
				"DESCR_TWO"
			),
			"RELATION" => array(
				"CODE"
			)
		);
		
		parent::setData($data);
	}
}

