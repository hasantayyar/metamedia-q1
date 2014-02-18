<?php

class CalcAverage extends OperationClass {

    public function __construct($args) {
        $this->args = $args;
    }

    public function process() {
        return array_sum($this->args) / count($this->args);
        // non-zero version : 
        // array_sum($arr) / count(array_filter($arr));
    }

}
