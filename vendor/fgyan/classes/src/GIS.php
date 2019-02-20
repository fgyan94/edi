<?php

namespace edi;

class GIS extends SEGMENT {
	public function __construct() {
		$data = array (
				"ID" => array (
						"ID"
				),
				"PROCESS_IDENT" => array (
						"ID",
						"QUALIFIER",
						"AGENCY",
						"TYPE_ID"
				)
		);

		parent::setData ( $data );
	}
	public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(), $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
		array_unshift ( $_CLASS_IGNORE, 'LIN' );
		parent::start ( $_INDEX, $_LINE, 'NAD', $_CLASS_IGNORE, $_HAS_START, 'SEG07' );

		array_shift ( $_CLASS_IGNORE );
		parent::start ( $_INDEX, $_LINE, 'LIN', $_CLASS_IGNORE );
	}
}

