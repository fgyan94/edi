<?php

namespace edi;

class PAC extends SEGMENT {
	private $_QTY;
	public function __construct() {
		$data = array (
				"ID" => array (
						"ID"
				),
				"NUMBER_OF_PACKS" => array (
						"NUMBER"
				),
				"DETAILS" => array (
						"LEVEL",
						"RELATED_INFO",
						"TERMS_COND"
				),
				"TYPE" => array (
						"ID",
						"QUALIFIER",
						"AGENCY",
						"TYPE_OF"
				),
				"TYPE_ID" => array (
						"DESCR_TYPE",
						"TYPE_OF",
						"NUMBER"
				),
				"RETURN_PACK_DETAILS" => array (
						"PAY_RESP",
						"LOAD_CONT"
				)
		);

		parent::setData ( $data );
	}
	public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(), $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
		if ($_STRATEGY === EDI::_DELJIT_STRATEGY_) {
			parent::start ( $_INDEX, $_LINE, 'PCI', $_CLASS_IGNORE, false );
		} else {

			array_unshift ( $_CLASS_IGNORE, 'PCI' );
			array_unshift ( $_CLASS_IGNORE, 'DTM' );
			array_unshift ( $_CLASS_IGNORE, 'QTY' );

			parent::start ( $_INDEX, $_LINE, 'MEA', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'QTY', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'DTM', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'PCI', $_CLASS_IGNORE );
		}
	}
}