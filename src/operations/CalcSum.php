<?php

class CalcSum extends OperationClass {
    public function __construct($args) {
        $this->args = $args;
    }
    public function process(){
        return array_sum($this->args);
    }
}