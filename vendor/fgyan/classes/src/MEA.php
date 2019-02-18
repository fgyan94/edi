<?php

namespace edi;

class MEA extends SEGMENT {
	
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
			"PURP_QUAL" => array(
				"QUALIFIER"
			),
			"DETAILS" => array(
				"PROPERTY",
				"SIGNIF",
				"ATTRIBUTE_ID",
				"ATTRIBUTE"
			),
			"VALUE_RANGE" => array(
				"MEASURE_UNIT",
				"MEASURE_VALUE",
				"RANGE_MIN",
				"RANGE_MAX",
				"SIGNIF_DIG"
			),
			"SURFACE_LAYER" => array(
				"ID"
			)
		);
		
		parent::setData($data);
	}
}

