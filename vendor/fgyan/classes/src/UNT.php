<?php

namespace edi;

class UNT extends SEGMENT {
	
	public function __construct() {
		$data = array(
			"ID" => array(
				"ID"
			),
			"NUMBER_SEGMENT" => array(
				"NUMBER"
			),
			"NUMBER_REF" =>array(
				"NUMBER"
			)
		);
		
		parent::setData($data);
	}
}

