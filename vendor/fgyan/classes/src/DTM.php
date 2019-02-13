<?php
namespace edi;

class DTM extends SEGMENT {

    public function __construct() {
        $data = array(
            "ID" => array(
                "ID"
            ),
            "DTM_PERIOD" => array(
                "QUALIFIER",
                "DATE_TIME",
                "FORMAT_QUALIFIER"
            )
        );

        $this->setData($data);
    }

    public function convert() {
        foreach ($this->getValues() as $key => $value) {
            foreach ($value as $sub_key => $sub_value) {
                if ($sub_key == 'DATE_TIME') {
                    $strtotime = strtotime($sub_value);
                    $data = date('d/m/Y', $strtotime);
                    $this->getValues()[$key][$sub_key] = $data;

                    return $data;
                }
            }
        }
    }
}

?>