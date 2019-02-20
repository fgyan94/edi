<?php

namespace edi;

class LOC extends SEGMENT {
	public function __construct() {
		$data = array (
				"ID" => array (
						"ID"
				),
				"PLACE" => array (
						"QUALIFIER"
				),
				"LOCATION" => array (
						"ID",
						"QUALIFIER",
						"AGENCY",
						"DESCR"
				),
				"RELATED_LOC_ONE" => array (
						"ID",
						"QUALIFIER",
						"AGENCY",
						"DESCR_ONE"
				),
				"RELATED_LOC_TWO" => array (
						"ID",
						"QUALIFIER",
						"AGENCY",
						"DESCR_TWO"
				),
				"RELATION" => array (
						"CODE"
				)
		);

		parent::setData ( $data );
	}
	public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(), $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
		parent::start ( $_INDEX, $_LINE, 'CTA' );
	}
}

