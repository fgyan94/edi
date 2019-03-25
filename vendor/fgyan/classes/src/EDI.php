<?php

namespace edi;

class EDI {
	public const _DELFOR_STRATEGY_ = 0;
	public const _DELJIT_STRATEGY_ = 1;
	public const _DELFOR_ = 'DELFOR';
	public const _DELJIT_ = 'DELJIT';
	
	private $_FILENAME;
	private $_FILE_1;
	private $_FILE_2;
	private $_INSTANCE;
	
	public function __construct($_FILENAME) {
		$this->_FILENAME = $_FILENAME;
	}
	public function startExplode() {
		$this->_FILE_1 = fopen ( $this->_FILENAME, 'r' );
		$this->_FILE_2 = fopen ( $this->_FILENAME, 'r' );

		$this->lineExplode ();
		$this->compareLines ();
		$this->build ();
        
		if($this->_INSTANCE == null) {
		    echo "<script>
                    alert('"
                            ."Não foi possível gerar nenhum relatório a partir do arquivo carregado..." 
                            ."Por favor, selecione outro arquivo e tente novamente!"
                    ."');
                    window.location = '/';
            </script>";
		    exit ();
		}
		
		$this->_INSTANCE->startExplode();
	}
	private function lineExplode() {
		$this->_LINES_1 = explode ( "'", fgets ( $this->_FILE_1 ) );

		for($i = 0; ! feof ( $this->_FILE_2 ); $i ++) {
			$this->_LINES_2 [$i] = fgets ( $this->_FILE_2 );
		}
	}
	private function compareLines() {
		if (count ( $this->_LINES_1 ) > count ( $this->_LINES_2 ))
			$this->_FINAL_LINES = $this->_LINES_1;
		else
			$this->_FINAL_LINES = $this->_LINES_2;
	}
	protected function build() {
		for($i = 0; $i < count ( $this->_FINAL_LINES ); $i ++) {
			$_VALUE = $this->_FINAL_LINES [$i];
			$_SUBS = substr ( $_VALUE, 0, 3 );

			if ('UNH' === $_SUBS) {
				$_SUBS = "\\edi\\" . $_SUBS;
				$_SEG = new $_SUBS ();
				$_SEG->dismember ( $_VALUE );

				$_VALUES = $_SEG->getValues () ['MESSAGE_IDENT'] ['TYPE'];
				if (strtoupper ( $_VALUES ) === self::_DELFOR_)
					$this->_INSTANCE = new DELFOR ( $this->_FILENAME );
				else if (strtoupper ( $_VALUES ) === self::_DELJIT_)
					$this->_INSTANCE = new DELJIT ( $this->_FILENAME );
				else {
					echo "<script>
									alert('O arquivo carregado é inválido ou está corrompido!');
									window.location = '/';
								</script>";
					exit ();
				}
			}
		}
	}
	public function getInstance() {
		return $this->_INSTANCE;
	}
	public function __destruct() {
		fclose($this->_FILE_1);
		fclose($this->_FILE_2);
		unset($this->_FILENAME);
		unset($this->_INSTANCE);
	}
}

