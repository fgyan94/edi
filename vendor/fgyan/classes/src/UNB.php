<?php

namespace edi;

class UNB extends SEGMENT {
	
	public function __construct() {
		$data = array(
			"ID" => array (
				"ID"
			),
			"SYNTAX" => array(
				"IDENTIFIER",
				"VERSION_NUMBER"
			),
			"INTERCHANGE_SENDER" => array(
				"ID",
				"QUALIFIER",
				"ADD_REV_ROUT"
			),
			"INTERCHANGE_RECIPIENT" => array(
				"ID",
				"QUALIFIER",
				"ROUT_ADD"
			),
			"DT_TM_PREP" => array(
				"DATE",
				"TIME",
			),
			"INTERCHANGE_CONTROL_REF" => array(
				"ID"
			),
			"RECIPIENT_PASS" => array(
				"PASS",
				"QUALIFIER"
			),
			"APP_REF" => array(
				"CODE"
			),
			"PROC_PRIOR_CODE" => array(
				"CODE"
			),
			"ACKNOW_REQ" => array(
				"CODE"
			),
			"COMM_AGRREM_ID" => array(
				"ID"
			),
			"TEST_INDIC" => array(
				"NUM"
			)
		);
		
		$this->setData($data);
	}
	
	public function start($index, $line, $className, $classIgnore = array(), $hasStart = true, $seg_number = 0) {
		$classIgnore = array("BGM", "DTM", "FTX", "RFF", "NAD", "TDT", "GIS", "UNT", "UNH", "UNZ");
		parent::start($index, $line, 'UNH', $classIgnore);
		
		array_shift($classIgnore);
		parent::start($index, $line, 'UNZ', $classIgnore, false);
	}
}

