<?php

class CalcMax extends OperationClass {

    public function __construct($args) {
        $this->args = $args;
    }

    public function process() {
        return max($this->args);
    }

}
