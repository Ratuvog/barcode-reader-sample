<?php

class FileNameProvider {
    private $fileName = null;
    private $temporary = false;
    
    function  __construct($options) {
        if (isset($options["input"]) || isset($options["i"])) {
            $temporaryFileName = $this->generateRandomString();
            $encoded_image = trim(fgets(STDIN));
            file_put_contents($temporaryFileName, base64_decode($encoded_image));
            $this->fileName = $temporaryFileName;
            $this->temporary = true;
        }
        
        if (isset($options["file"])) {
            $this->fileName = $options["file"];
            
        }
    
        if (isset($options["f"])) {
            $this->fileName = $options["f"];
        
        }
    }
    
    function  __destruct() {
        if ($this->temporary) {
            unlink($this->fileName);
        }
    }
    
    public function getFileName() {
        return $this->fileName;
    }
    
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}