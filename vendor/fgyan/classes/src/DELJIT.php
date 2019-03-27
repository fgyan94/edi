<?php

namespace edi;

class DELJIT extends DELFOR {
	public function __construct($_FILENAME) {
		parent::__construct ( $_FILENAME );
		$this->setStrategy ( EDI::_DELJIT_STRATEGY_ );

		$GLOBALS ['STRATEGY'] = $this->getStrategy ();
	}
	protected function setData() {
		$_SEG = array (
				"ID_DOC_MSG" => 'Não localizado',
				"FUNCTION_MSG" => 'Não localizado',
				"GENERATE_DATE" => 'Não localizado',
				"INI_HORIZ" => 'Não localizado',
				"END_HORIZ" => 'Não localizado',
				"EMITENTE" => 'Não localizado',
				"STATUS_INDIC" => 'Não localizado',
		        "PLANTA" => 'Não localizado',
				"LIN" => array ()
		);

		parent::setSEG ( $_SEG );

		$this->runArray ( $this->get (), 'UNH' );
		$this->setID_DOC_MSG ( $GLOBALS ['SEG'] );

		$this->runArray ( $this->get (), 'BGM' );
		$this->setFUNCTION_MSG ( $GLOBALS ['SEG']->getValues () );

		$this->runArray ( $this->get (), 'UNB' );
		$this->setEMITENTE ( $GLOBALS ['SEG']->getValues () );

		$this->runArray ( $this->get (), 'SEQ' );
		$this->setSTATUS_INDIC ( $GLOBALS ['SEG'] );
		
		$GLOBALS['SEG_ARRAY'] = array();
		$this->runArray($this->get(), 'NAD', true);
		$this->setPlanta($GLOBALS['SEG_ARRAY']);
		
	}
	private function setSTATUS_INDIC($_SEQ) {
		$_VALUES = $_SEQ->getValues ();

		if (! isset ( $_VALUES ['STATUS_INDIC'] ['CODE'] )) {
			echo "<script>
					alert('O arquivo carregado é inválido ou está corrompido!');
					window.location = '/';
				</script>";
			exit ();
		}

		$_PROCESS_INDIC = $_VALUES ['STATUS_INDIC'] ['CODE'];
		$this->_SEG ['STATUS_INDIC'] = ( int ) $_PROCESS_INDIC;
	}
	public function getStatusIndic() {
		return $this->_SEG ['STATUS_INDIC'];
	}
	protected function setID_DOC_MSG($_UNH) {
		parent::setID_DOC_MSG ( $_UNH );

		for($i = 0; $i < count ( $_UNH->getSubSeg () ); $i ++) {
			$_SEQ = $_UNH->getSubSeg () [$i];
			if ($_SEQ instanceof SEQ) {
				for($j = 0; $j < count ( $_SEQ->getSubSeg () ); $j ++) {
					$_LIN = $_SEQ->getSubSeg () [$j];
					if ($_LIN instanceof LIN) {
						$this->pushLIN ( $_LIN );
					}
				}
			}
		}
	}
	    
	public function getStrategyName() {
		return EDI::_DELJIT_;
	}
	public function __destruct() {
		parent::__destruct ();
	}
}

