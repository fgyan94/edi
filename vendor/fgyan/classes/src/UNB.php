<?php

namespace edi;

class UNB extends SEGMENT {
	public function __construct() {
		$data = array (
				"ID" => array (
						"ID"
				),
				"SYNTAX" => array (
						"IDENTIFIER",
						"VERSION_NUMBER"
				),
				"INTERCHANGE_SENDER" => array (
						"ID",
						"QUALIFIER",
						"ADD_REV_ROUT"
				),
				"INTERCHANGE_RECIPIENT" => array (
						"ID",
						"QUALIFIER",
						"ROUT_ADD"
				),
				"DT_TM_PREP" => array (
						"DATE",
						"TIME"
				),
				"INTERCHANGE_CONTROL_REF" => array (
						"ID"
				),
				"RECIPIENT_PASS" => array (
						"PASS",
						"QUALIFIER"
				),
				"APP_REF" => array (
						"CODE"
				),
				"PROC_PRIOR_CODE" => array (
						"CODE"
				),
				"ACKNOW_REQ" => array (
						"CODE"
				),
				"COMM_AGRREM_ID" => array (
						"ID"
				),
				"TEST_INDIC" => array (
						"NUM"
				)
		);

		$this->setData ( $data );
	}
	public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(), $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
		parent::start ( $_INDEX, $_LINE, 'UNH', $_CLASS_IGNORE, $_HAS_START, $_SEG_NUMBER, $_STRATEGY );

		array_shift ( $_CLASS_IGNORE );
		parent::start ( $_INDEX, $_LINE, 'UNZ', $_CLASS_IGNORE, false, $_SEG_NUMBER, $_STRATEGY );
	}
}

