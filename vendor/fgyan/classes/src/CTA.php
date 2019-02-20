<?php

namespace edi;

class CTA extends SEGMENT {
	public function __construct() {
		$data = array (
				"ID" => array (
						"ID"
				),
				"CONTACT_FUNCTION" => array (
						"CODE"
				),
				"DEPART_OR_EMPLOY" => array (
						"ID",
						"NAME"
				)
		);
		parent::setData ( $data );
	}
	public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(), $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
		parent::start ( $_INDEX, $_LINE, 'COM', $_CLASS_IGNORE, false );
	}
}

