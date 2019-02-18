<?php

namespace edi;

class BGM extends SEGMENT {
	
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
			"DOCUMENT_MESSAGE" => array(
				"NAME_CODED",
				"QUALIFIER",
				"RESP_AGENCY",
				"NAME"
			),
			"DOCUMENT_MESSAGE_CODED" => array(
				"CODE"
			),
			"RESP_TYPE" => array(
				"CODE"
			)
		);
		
		parent::setData($data);
	}
}

