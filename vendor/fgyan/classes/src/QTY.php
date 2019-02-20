<?php

namespace edi;

class QTY extends SEGMENT {
	public function __construct() {
		$data = array (
				"ID" => array (
						"ID"
				),
				"QUALIFIER" => array (
						"ID",
						"QUANTITY",
						"MEASUREUNIT"
				)
		);

		$this->setData ( $data );
	}
	public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(), $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
		if ($_STRATEGY === EDI::_DELJIT_STRATEGY_) {
			array_unshift ( $_CLASS_IGNORE, "DTM" );
			parent::start ( $_INDEX, $_LINE, 'SCC', $_CLASS_IGNORE, false );
		}

		array_unshift ( $_CLASS_IGNORE, "RFF" );
		parent::start ( $_INDEX, $_LINE, 'DTM', $_CLASS_IGNORE, false );

		array_shift ( $_CLASS_IGNORE );
		parent::start ( $_INDEX, $_LINE, 'RFF', $_CLASS_IGNORE );
	}
}
?>