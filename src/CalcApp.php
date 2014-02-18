<?php

require 'operations/Calculator.php';
require 'CalcException.php';

/**
 * @author <tayyar.besik@gmail.com> Tayyar
 * */
class CalcApp {

    public $rawInput;
    private $inputLines;
    private $ops = array('MIN', 'MAX', 'AVERAGE', 'SUM');

    public function __construct($input = NULL) {
        if (!$input) {
            $this->rawInput = $this->readStdin();
        } else {
            $this->rawInput = $input;
        }
        $this->processLines();
    }

    public function processLines($verbose = TRUE) {
        $this->parseLines();
        foreach ($this->inputLines as $line) {
            if (!in_array($line['op'], $this->ops)) {
                throw new CalcException("Undefined operation : " . $line["op"], 4);
            }
            $class = "Calc" . ucfirst(strtolower($line['op']));
            echo $line['op'] . ' : ' . implode(',', $line['args']);
            echo ' => '.(new $class($line['args']))->process();
            echo "\n";
        }
    }

    public function showUsage() {
        echo "\nUSAGE\n=====\n";
        echo "php app <input_file_path>\n";
    }

    private function readStdin() {
        global $argv;
        if (!isset($argv[1])) {
            $this->showUsage();
            exit(); //throw new CalcException("Missing argument",1);
        }
        $inputFile = $argv[1];
        try {
            $file = fopen($inputFile, 'r');

            if (!$file) {
                new CalcException("Could not open the file!", 2);
                exit();
            }
        } catch (CalcException $cexp) {
            throw new CalcException("File error", 3);
        }
        $raw = fread($file, filesize($inputFile));
        fclose($file);
        return $raw;
    }

    private function parseLines() {
        $lines = explode("\n", $this->rawInput);
        foreach ($lines as $line) {
            $opLine = array();
            if (!empty($line)) {
                list($opLine["op"], $opLine['args']) = explode(":", $line);
                $opLine['args'] = explode(',', $opLine['args']);
                if (empty($opLine['args'])) {
                    throw new CalcException('Syntax error in input file. Missing argument for ' . $opLine["op"]);
                }
                $this->inputLines[] = $opLine;
            }
        }
    }

}
