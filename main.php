<?php

function ReadBarcode2D ($fileName, $page = 0)
{
    // Create ClearImage COM Server
    $Ci = new COM("ClearImage.ClearImage");
    // Creare and configure barcode reader
    $reader = $Ci->CreatePdf417();
    // $reader = $Ci->CreateDataMatrix();
    // $reader = $Ci->CreateQR();
    //  Open image file
    $reader->Image->Open($fileName, $page);
    // Read barcodes
    $BCcount = $reader->Find(0);
    // Process Results
    for ($i=1;$i<=$BCcount;$i++) {
        $Bc = $reader->BarCodes($i);
        echo "$Bc->Text<br>";
    }
}

try {
    ReadBarcode2D("./sample.jpg");
} catch (Exception $e) {
    print "<br>\n" . "Exceptiom in line " . $e->getLine();
    print "<br>\n" . $e->getMessage() . "\n<br>";
}