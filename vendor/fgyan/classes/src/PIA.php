<?php

namespace edi;

class PIA extends SEGMENT {
	public function __construct() {
		$data = array (
				"ID" => array (
						"ID"
				),
				"ID_QUALIFIER" => array (
						"QUALIFIER"
				),
				"ITEM_NUMBER" => array (
						"NUMBER",
						"TYPE",
						"QUALIFIER",
						"AGENCY"
				)
		);

		parent::setData ( $data );
	}
}

?>