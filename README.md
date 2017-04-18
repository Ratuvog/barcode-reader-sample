# barcode-reader-sample
Barcode reader sample using Clear Image SDK

## Requirements
 - php 5.5+
 - ClearImage SDK 

## Install
Install Clear image SDK, then enable extension `php_com_dotnet.dll` in `php.ini`:
```
[PHP_COM_DOTNET] 
extension=C:\OpenServer\modules\php\PHP-5.5\ext\php_com_dotnet.dll
```

## Usage 
```
usage: php main.php [--help] [-f|--file=sample.jpg] [-i|--input]
Options:
    --help          Show this message
    -f  --file      Image file with barcode
    -i  --input     Get base64 encoded image from STDIN
Example:
    1) php main.php -f=sample.jpg
    2) type image_base64.txt | php main.php --input 
```

## Output
```
[  
   {  
      "confidence": integer,
      "raw_data": string,
      "encoding": integer,
      "error": integer,
      "checksum_verified": boolean,
      "length": integer,
      "data": string,       #decoded data
      "type": integer
   },
   ...
]
```
