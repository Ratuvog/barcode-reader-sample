<?php

class BarcodeReader {
    private $CI;
    private $reader;
    
    function __construct() {
        // Create ClearImage COM Server
        $this->CI = new COM("ClearImage.ClearImage");
        
        // Creare and configure barcode reader
        $this->reader = $this->CI->CreatePdf417();
    }
    
    public function fromFile($fileName) {
        //  Open image file
        $this->reader->Image->Open($fileName);
        
        // Read barcodes
        $bcCount = $this->reader->Find();
        
        return $this->processResults($bcCount);
    }
    
    private function processResults($bcCount)
    {
        $result = [];
        for ($i = 1; $i <= $bcCount; $i++) {
            $bc = $this->reader->BarCodes($i);
            $result []= [
                "confidence" => $bc->Confidence,
                "raw_data" => $bc->Data,
                "encoding" => $bc->Encoding,
                "error" => $bc->ErrorFlags,
                "checksum_verified" => $bc->IsChecksumVerified == 65535,
                "length" => $bc->Length,
                "data" => $bc->Text,
                "type" => $bc->Type
            ];
        }
        return $result;
    }
}