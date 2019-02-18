<?php

namespace edi;

class COM extends SEGMENT {
	
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
			"COMM_CONTACT" => array(
				"NUMBER",
				"CHANNEL_QUALIFIER"
			)
		);
		
		parent::setData($data);
	}
}

