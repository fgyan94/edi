<?php

namespace edi;

class DELFOR {
    private $file;
    private $lines_1 = [];
    private $lines_2 = [];
    private $final_lines = [];
    private $column = [];
    private $build = [];
    
    private $_TAGS = array(
        
        "LIN" => array()
        
    );
    
    private $_SEG;
    
    public function __construct($filename) {
        $this->file = fopen($filename, 'r');
    }
    
    public function startExplode() {
        $this->lineExplode();
        $this->compareLines();
        $this->build();
    }
    
    private function lineExplode() {
        $this->lines_1 = explode("'", fgets($this->file));
        
        for($i = 0; !feof($this->file); $i++) {
            $this->lines_2[$i] = fgets($this->file);
        }
    }
    
    private function compareLines() {
        if(count($this->lines_1) > count($this->lines_2))
            $this->final_lines = $this->lines_1;
        else
            $this->final_lines = $this->lines_2;
            
    }
    
    private function build() {
        for ($i = 0; $i < count($this->final_lines); $i++) {
            $value = $this->final_lines[$i];
            $subs = substr($value, 0, 3);
            
            if('LIN' === $subs) {
                $subs = "\\edi\\".$subs;
                $this->_SEG = new $subs();
                $this->_SEG->dismember($value);
                $this->_SEG->start($i, $this->final_lines, 'QTY', 'PAC');
                $i = $this->_SEG->getIndex();
                
                array_push($this->_TAGS['LIN'], $this->_SEG);
            }
        }
    }
    
    public function get() {
        return $this->_TAGS;
    }
    
    public function __destruct() {
        fclose($this->file);
        
        unset($this->lines_1);
        unset($this->lines_2);
        unset($this->final_lines);
        unset($this->column);
        unset($this->file);
    }
}

?>