<?php

namespace edi;

class TDT extends SEGMENT {
	public function __construct() {
		$data = array (
				"ID" => array (
						"ID"
				),
				"TRANSPORT_STAGE" => array (
						"QUALIFIER"
				),
				"CONVEY_REF" => array (
						"NUM"
				),
				"MODE" => array (
						"CODE"
				),
				"MEANS" => array (
						"TYPE"
				),
				"CARRIER" => array (
						"ID",
						"QUALIFIER",
						"CODED",
						"NAME"
				),
				"DIRECTION" => array (
						"CODE"
				),
				"EXCESS_INFO" => array (
						"REASON",
						"RESPONS",
						"AUTH_NUM"
				),
				"TRANS_IDENT" => array (
						"ID",
						"QUALIFIER",
						"CODE",
						"ID_MEANS",
						"NATIONALITY"
				),
				"OWNERSHIP" => array (
						"CODE"
				)
		);

		parent::setData ( $data );
	}
	public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(), $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
		parent::start ( $_INDEX, $_LINE, 'DTM', $_CLASS_IGNORE, false );
	}
}

