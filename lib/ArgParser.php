<?php

class ArgParser {
    private $options = [];
    
    function  __construct() {
        $params = [
            ''      => 'help',
            'f::'   => 'file::',
            'i::'    => 'input::',
        ];
        
        $this->options = getopt(implode('', array_keys($params)), $params);
        
        if (empty($this->options) || isset($this->options['help'])) {
            $this->printHelp();
        }
    }
    
    function printHelp() {
        $EXEC_NAME = EXEC_NAME;
        $help = "
        usage: php $EXEC_NAME [--help] [-f|--file=sample.jpg] [-i|--input]
        Options:
            --help          Show this message
            -f  --file      Image file with barcode
            -i  --input     Get base64 encoded image from STDIN
        Example:
            1) php $EXEC_NAME -f=sample.jpg
            2) type image_base64.txt | php $EXEC_NAME --input
        ";
        die($help);
    }
    
    public function getFileNameProvider() {
        return new FileNameProvider($this->options);
    }
}