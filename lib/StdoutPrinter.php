<?php

class StdoutPrinter {
    public function write($data) {
        fwrite(STDOUT, $data);
    }
}