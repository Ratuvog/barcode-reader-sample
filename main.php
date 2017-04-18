<?php

include 'lib/ArgParser.php';
include 'lib/FileNameProvider.php';
include 'lib/BarcodeReader.php';
include 'lib/StdoutPrinter.php';

const EXEC_NAME = "main.php";

function main()
{
    try {
        $argParser = new ArgParser();
        $provider = $argParser->getFileNameProvider();
        
        $reader = new BarcodeReader();
        $barcodes = $reader->fromFile($provider->getFileName());
        
        $printer = new StdoutPrinter();
        $printer->write(json_encode($barcodes));
    } catch (Exception $e) {
        handleGlobalError($e);
    } finally {
        unset($provider);
    }
}
main();

function handleGlobalError($e)
{
    print "<br>\n" . "Exceptiom in line " . $e->getLine();
    print "<br>\n" . $e->getMessage() . "\n<br>";
}