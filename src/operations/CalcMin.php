<?php

class CalcMin extends OperationClass {

    public function __construct($args) {
        $this->args= $args;
    }

    public function process() {
        return min($this->args);
    }

}
