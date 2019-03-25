<?php

namespace edi;

abstract class SEGMENT {
	private $_DATA = array (
			array ()
	);
	private $_SUB_SEG = array ();
	private $_INDEX = 0;
	public function dismember($line) {
		$values = array (
				array ()
		);
		$array = explode ( "+", $line );
		for($i = 0; $i < count ( $array ); $i ++) {
			$sub_array = explode ( ":", $array [$i] );
			for($j = 0; $j < count ( $sub_array ); $j ++) {
				$values [$i] [$j] = $sub_array [$j];
			}
		}

		reset ( $this->_DATA );
		for($i = 0; $i < count ( $values ); $i ++) {
			$key = key ( $this->_DATA );

			$count = min ( count ( $this->_DATA [$key] ), count ( $values [$i] ) );
			$this->_DATA [$key] = array_combine ( array_slice ( $this->_DATA [$key], 0, $count ), array_slice ( $values [$i], 0, $count ) );

			// $this->_DATA[$key] = array_combine($this->_DATA[$key], $values[$i]);

			next ( $this->_DATA );
		}
	}
	public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(), $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
		$this->_INDEX = $_INDEX + 1;
		do {

			$_VALUE = $_LINE [$this->_INDEX];
			$_SUBS = substr ( $_VALUE, 0, 3 );
			
			if ($this->_INDEX >= count ( $_LINE ) || $this->getValues()['ID']['ID'] === $_SUBS)
			    return;

			if ($_SUBS === $_CLASS_NAME) {
				$_EDI = "\\edi\\$_CLASS_NAME";
				$_SEG = new $_EDI ();
				$_SEG->dismember ( $_LINE [$this->_INDEX] );

				if ($_HAS_START)
					$_SEG->start ( $this->_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE, $_HAS_START, $_SEG_NUMBER, $_STRATEGY );

				$this->add ( $_SEG );
			}

			$this->_INDEX += 1;
		} while ( ! in_array ( $_SUBS, $_CLASS_IGNORE ) );
	}
	public function setData($data = array()) {
		$this->_DATA = $data;
	}
	public function setSubSeg($sub_seg = array()) {
		$this->_SUB_SEG = $sub_seg;
	}
	public function getSubSeg() {
		return $this->_SUB_SEG;
	}
	public function getValues() {
		return $this->_DATA;
	}
	public function getIndex() {
		return $this->_INDEX;
	}
	public function add(SEGMENT $_SEG) {
		array_push ( $this->_SUB_SEG, $_SEG );
	}
}

?>