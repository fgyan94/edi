<?php

namespace edi;

class LIN extends SEGMENT {
	private $_ITEM_VALUES = array (
			"PART_NUMBER" => "Não localizado",
	        "DOCA" => "Não localizado",
	        "MATERIAL_HANDLING" => "Não localizado",
	        "PEDIDO" => "Não localizado",
			"QTY_ULTIMA_ENTREGA" => 0,
            "DATA_ULTIMA_ENTREGA" => "Não localizado",
			"TYPE" => array (),
			"FREQUENCY" => array (),
			"DATE_TIME" => array (),
			"QUANTITY" => array (),
			"ACCUMULATED" => array ()
	);
	public function __construct() {
		$data = array (
				"ID" => array (
						"ID"
				),
				"NUMBER" => array (
						"NUMBER"
				),
				"ACTION" => array (
						"CODE"
				),
				"PARTNUMBER" => array (
						"CODE",
						"TYPE"
				)
		);

		$this->setData ( $data );
	}
	public function setPIA(PIA $_PIA) {
		$this->PIA = $_PIA;
	}
	public function start($_INDEX, $_LINE, $_CLASS_NAME, $_CLASS_IGNORE = array(), $_HAS_START = true, $_SEG_NUMBER = 0, $_STRATEGY = EDI::_DELFOR_STRATEGY_) {
		if ($_STRATEGY === EDI::_DELJIT_STRATEGY_) {
			array_unshift ( $_CLASS_IGNORE, 'QTY' );
			array_unshift ( $_CLASS_IGNORE, 'LOC' );
			array_unshift ( $_CLASS_IGNORE, 'RFF' );
			array_unshift ( $_CLASS_IGNORE, 'PAC' );
			array_unshift ( $_CLASS_IGNORE, 'FTX' );
            array_unshift ( $_CLASS_IGNORE, 'DTM' );
			array_unshift ( $_CLASS_IGNORE, 'GIR' );
			array_unshift ( $_CLASS_IGNORE, 'ALI' );
			array_unshift ( $_CLASS_IGNORE, 'IMD' );

			parent::start ( $_INDEX, $_LINE, 'PIA', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'IMD', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'ALI', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'GIR', $_CLASS_IGNORE, false );

            array_shift ( $_CLASS_IGNORE );
            parent::start ( $_INDEX, $_LINE, 'DTM', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'FTX', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'PAC', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'RFF', $_CLASS_IGNORE );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'LOC', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'QTY', $_CLASS_IGNORE, true, 0, EDI::_DELJIT_STRATEGY_ );
		} else {

			array_unshift ( $_CLASS_IGNORE, 'NAD' );
			array_unshift ( $_CLASS_IGNORE, 'PAC' );
			array_unshift ( $_CLASS_IGNORE, 'SCC' );
			array_unshift ( $_CLASS_IGNORE, 'QTY' );
			array_unshift ( $_CLASS_IGNORE, 'TDT' );
			array_unshift ( $_CLASS_IGNORE, 'RFF' );
			array_unshift ( $_CLASS_IGNORE, 'FTX' );
			array_unshift ( $_CLASS_IGNORE, 'DTM' );
			array_unshift ( $_CLASS_IGNORE, 'LOC' );
			array_unshift ( $_CLASS_IGNORE, 'GIR' );
			array_unshift ( $_CLASS_IGNORE, 'GIN' );
			array_unshift ( $_CLASS_IGNORE, 'ALI' );
			array_unshift ( $_CLASS_IGNORE, 'MEA' );
			array_unshift ( $_CLASS_IGNORE, 'IMD' );

			parent::start ( $_INDEX, $_LINE, 'PIA', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'IMD', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'MEA', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'ALI', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'GIN', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'GIR', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'LOC', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'DTM', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'FTX', $_CLASS_IGNORE, false );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'RFF', $_CLASS_IGNORE );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'TDT', $_CLASS_IGNORE );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'QTY', $_CLASS_IGNORE );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'SCC', $_CLASS_IGNORE );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'PAC', $_CLASS_IGNORE );

			array_shift ( $_CLASS_IGNORE );
			parent::start ( $_INDEX, $_LINE, 'NAD', $_CLASS_IGNORE, true, 'SEG22' );
		}
	}
	
	public function startFormat() {
		$this->setPartNumber ();
		$this->setDoca();
		$this->setMaterialHandling();
		$this->setPedido();
		$this->setType ();
		$this->setFrequency ();
		$this->setDateTime ();
		$this->setQuantity ();
		$this->setAccumulated ();
		$this->setQtyUE();
        $this->setDataUE();
	}
	
	private function setPartNumber() {
		$this->_ITEM_VALUES ['PART_NUMBER'] = $this->getValues () ['PARTNUMBER'] ['CODE'];
	}
	
	private function setType() {
		foreach ( $this->getSubSeg () as $key => $value ) {
			if ($value instanceof SCC) {
			    if ($value->getValues () ['STATUS_INDIC'] ['NUMBER'] == 4 || $value->getValues () ['STATUS_INDIC'] ['NUMBER'] == 1) {

					for($i = 0; $i < count ( $value->getSubSeg () ); $i ++) {
						array_push ( $this->_ITEM_VALUES ['TYPE'], $value->getValues () ['STATUS_INDIC'] ['NUMBER'] );
					}
				}
			}
		}
	}
	
	private function setFrequency() {
		foreach ( $this->getSubSeg () as $key => $value ) {
			if ($value instanceof SCC) {
			    if ($value->getValues () ['STATUS_INDIC'] ['NUMBER'] == 4 || $value->getValues () ['STATUS_INDIC'] ['NUMBER'] == 1) {

					for($i = 0; $i < count ( $value->getSubSeg () ); $i ++) {
						if (isset ( $value->getValues () ['PATTERN_DESCR'] ['FREQUENCY'] ))
							array_push ( $this->_ITEM_VALUES ['FREQUENCY'], $value->getValues () ['PATTERN_DESCR'] ['FREQUENCY'] );
					}
				}
			}
		}
	}
	
	private function setDateTime() {
		foreach ( $this->getSubSeg () as $key => $value ) {
			if ($value instanceof SCC) {
			    if ($value->getValues () ['STATUS_INDIC'] ['NUMBER'] == 4 || $value->getValues () ['STATUS_INDIC'] ['NUMBER'] == 1) {

					foreach ( $value->getSubSeg () as $sub_key => $sub_value ) {
						$this->checkDateTime ( $sub_value );
					}
				}
			} 
			else if ($GLOBALS ['STRATEGY'] === EDI::_DELJIT_STRATEGY_) {
				$this->checkDateTime ( $value );
			}
		}
	}
	
	private function checkDateTime($_QTY) {
		if ($_QTY instanceof QTY) {
			foreach ( $_QTY->getSubSeg () as $sub_key_2 => $sub_value_2 ) {
				if ($sub_value_2 instanceof DTM) {
				    $_DTM_DELJIT = $sub_value_2->getValues () ['DTM_PERIOD'] ['QUALIFIER'];
				    $_STR_DELJIT = ($GLOBALS ['STRATEGY'] === EDI::_DELJIT_STRATEGY_) && $_DTM_DELJIT == 10;
				    
				    if ($GLOBALS ['STRATEGY'] === EDI::_DELFOR_STRATEGY_ || $_STR_DELJIT) {
    					$timestamp = strtotime ( $sub_value_2->getValues () ['DTM_PERIOD'] ['DATE_TIME'] );
    					$date = date ( 'd/m/Y', $timestamp );
    					array_push ( $this->_ITEM_VALUES ['DATE_TIME'], $date );
				    }
				}
			}
		}
	}
	
	private function setQuantity() {
		foreach ( $this->getSubSeg () as $key => $value ) {
			if ($value instanceof SCC) {
			    if ($value->getValues () ['STATUS_INDIC'] ['NUMBER'] == 4 || $value->getValues () ['STATUS_INDIC'] ['NUMBER'] == 1) {

					foreach ( $value->getSubSeg () as $sub_key => $sub_value ) {
						$this->checkQuantity ( $sub_value );
					}
				}
			} else if ($GLOBALS ['STRATEGY'] === EDI::_DELJIT_STRATEGY_) {
			    $this->checkQuantity ( $value );
			}
		}
	}
	
	private function checkQuantity($_QTY) {
		if ($_QTY instanceof QTY) {
			if ($_QTY->getValues () ['QUALIFIER'] ['ID'] == 1)
				array_push ( $this->_ITEM_VALUES ['QUANTITY'], $_QTY->getValues () ['QUALIFIER'] ['QUANTITY'] );
		}
	}
	
	private function setAccumulated() {
		$_TEMP_ACCUMULATED = 0;

		// Solicitação feita por Maurício - 19/06

//		foreach ( $this->getSubSeg () as $key => $value ) {
//			if ($value instanceof QTY) {
//				if ($value->getValues () ['QUALIFIER'] ['ID'] == 79) {
//					$_TEMP_ACCUMULATED = $value->getValues () ['QUALIFIER'] ['QUANTITY'];
//					break;
//				}
//			}
//		}

		for($i = 0; $i < count ( $this->_ITEM_VALUES ['QUANTITY'] ); $i ++) {
			$_TEMP_ACCUMULATED += $this->_ITEM_VALUES ['QUANTITY'] [$i];
			array_push ( $this->_ITEM_VALUES ['ACCUMULATED'], $_TEMP_ACCUMULATED );
		}
	}

	private function setQtyUE() {
		foreach ( $this->getSubSeg () as $key => $value ) {
			if ($value instanceof QTY) {
				if ($value->getValues () ['QUALIFIER'] ['ID'] == 3) {
					$this->_ITEM_VALUES['QTY_ULTIMA_ENTREGA'] = $value->getValues () ['QUALIFIER'] ['QUANTITY'];
					break;
				}
			}
		}
    }

    private function setDataUE() {

	    foreach ( $this->getSubSeg () as $key => $value ) {
            if ($value instanceof QTY) {
                if ($value->getValues () ['QUALIFIER'] ['ID'] == 3) {
                   $_DTM = $value->getSubSeg();

                   if($this->getDate($_DTM))
                       break;
                }
            }
        }
    }

    private function getDate($_DTM) {
        foreach ($_DTM as $sub_key => $sub_value) {
            if($sub_value instanceof DTM) {
                if($sub_value->getValues()['DTM_PERIOD']['QUALIFIER'] == 11){

                    $timestamp = strtotime ( $sub_value->getValues () ['DTM_PERIOD'] ['DATE_TIME'] );
                    $date = date ( 'd/m/Y', $timestamp );

                    $this->_ITEM_VALUES['DATA_ULTIMA_ENTREGA'] = $date;
                    return true;
                }
            }
        }

        return false;
    }
	
	private function getLOC(int $index) {
	    foreach ($this->getSubSeg() as $key => $value) {
	        if($value instanceof LOC) {
	            if($value->getValues()['PLACE']['QUALIFIER'] == $index)
	                return $value->getValues()['LOCATION']['ID'];
	        }
	    }
	}
	
	private function setDoca() {
	    $this->_ITEM_VALUES['DOCA'] = $this->getLOC(11);
	}
	
	private function setMaterialHandling() {
	    $this->_ITEM_VALUES['MATERIAL_HANDLING'] = $this->getLOC(159);
	}
	
	private function setPedido() {
	    foreach ($this->getSubSeg() as $key => $value) {
	        if($value instanceof RFF) {
	            
	            if($value->getValues()['REF']['QUALIFIER'] == 'ON') {
	                $this->_ITEM_VALUES['PEDIDO'] = $value->getValues()['REF']['NUMBER'];
	                break;
	            }
	        }
	    }
	}
	
	public function getPartNumber() {
		return $this->_ITEM_VALUES ['PART_NUMBER'];
	}
	
	public function getLineItemValues() {
		return $this->_ITEM_VALUES;
	}
	
	public function getCount() {
		return count ( $this->_ITEM_VALUES ['QUANTITY'] );
	}
	
	public function getDoca() {
	    return $this->_ITEM_VALUES['DOCA'];
	}
	
	public function getMaterialHandling() {
	    return $this->_ITEM_VALUES['MATERIAL_HANDLING'];
	}
	
	public function getPedido() {
	    return $this->_ITEM_VALUES['PEDIDO'];
	}

	public function getQtyUE() {
	    return $this->_ITEM_VALUES['QTY_ULTIMA_ENTREGA'];
    }

    public function getDataUE() {
	    return $this->_ITEM_VALUES['DATA_ULTIMA_ENTREGA'];
    }
}

?>