<?php
namespace edi;

abstract class SEGMENT {
    private $_DATA = array(array());
    private $_SUB_SEG = array();
    
    private $_INDEX = 0;
    
    public function dismember($line){
        $values = array(array());
        $array = explode("+", $line);
        for($i = 0; $i < count($array); $i++){
            $sub_array = explode(":", $array[$i]);
            for($j = 0; $j < count($sub_array); $j++) {
                $values[$i][$j] = $sub_array[$j];
            }
        }
        
        reset($this->_DATA);
        for($i = 0; $i < count($values); $i++) {
            $key = key($this->_DATA);
            $this->_DATA[$key] = array_combine($this->_DATA[$key], $values[$i]);

            next($this->_DATA);
        }
    }
    
    public function start($index, $line, $className, $classIgnore, $hasStart = true){
        $this->_INDEX = $index+1;
        do {
            if($this->_INDEX >= count($line))
                return;
            
            $value = $line[$this->_INDEX];
            $subs = substr($value, 0, 3);
            
            if($subs === $className) {
                $_EDI = "\\edi\\$className";
                $_SEG = new $_EDI();
                $_SEG->dismember($line[$this->_INDEX]);
                
                if($hasStart) 
                    $_SEG->start($this->_INDEX, $line, $className, $classIgnore, $hasStart);
                
                $this->add($_SEG);
            }
            
            $this->_INDEX+=1;
        } while($subs != $classIgnore);
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
    
    public function add(SEGMENT $_SEG){
        array_push($this->_SUB_SEG, $_SEG);
    }
}

?>