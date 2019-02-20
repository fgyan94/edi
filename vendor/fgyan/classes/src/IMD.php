<?php

namespace edi;

class IMD extends SEGMENT {
	public function __construct() {
		$data = array (
				"ID" => array (
						"ID"
				),
				"TYPE" => array (
						"CODE"
				),
				"CHARACT" => array (
						"CODE"
				),
				"DESCRIPTION" => array (
						"ID",
						"QUALIFIER",
						"AGENCY",
						"DESCR",
						"LANG"
				),
				"SURF_LAYER" => array (
						"ID"
				)
		);

		parent::setData ( $data );
	}
}

