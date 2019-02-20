<?php

namespace edi;

class UNH extends SEGMENT {
	public function __construct() {
		$data = array (
				"ID" => array (
						"ID"
				),
				"MESSAGE_REF_NUM" => array (
						"ID"
				),
				"MESSAGE_IDENT" => array (
						"TYPE",
						"VERSION",
						"RELEASE",
						"AGENCY",
						"ASSIGN_CODE"
				),
				"ACC_REF" => array (
						"CODE"
				),
				"STATUS_TRANS" => array (
						"SEQ",
						"FIRST_LAST"
				)
		);

		$this->setData ( $data );
	}
	public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(), $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
		if ($_STRATEGY === EDI::_DELJIT_STRATEGY_) {
			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'BGM', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'DTM', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'FTX', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'RFF', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'NAD', $_CLASS_IGNORE, true, $_SEG_NUMBER, EDI::_DELJIT_STRATEGY_ );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'SEQ', $_CLASS_IGNORE );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'UNT', $_CLASS_IGNORE, false );
		} else {
			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'BGM', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'DTM', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'FTX', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'RFF', $_CLASS_IGNORE );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'NAD', $_CLASS_IGNORE, true, 'SEG02' );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'TDT', $_CLASS_IGNORE );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'GIS', $_CLASS_IGNORE );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'UNT', $_CLASS_IGNORE, false );
		}
	}
}