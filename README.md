# wkhtmltopdf-api-php-client


## Installation

```bash
composer require ctbuh\wkhtmltopdf-api-php-client
```

### API

- `convert($bytes, $options = array())`
- `inline($bytes, $options = array(), $filename = 'document.pdf')`
- `download($bytes, $options = array(), $filename = 'document.pdf')`

### Visual Demo

https://wkhtmltopdf.api.ctbuh.org/


### Code Examples

```php
use ctbuh\PdfApi\PdfApi;

$pdf = new Pdf();
$pdf->inline("<h1>hello world</h1>");
// script stops

$html = view('admin.membership-certificates.document', $data)->render();

$pdf = new PdfApi();
$pdf->inline($html, [
    'orientation' => 'Landscape',
    'page-size' => 'letter',
    'no-outline' => true
]);
```

### Other PDF stuff
 
 ```shell
 wget https://github.com/coherentgraphics/cpdf-binaries/raw/master/Linux-Intel-64bit/cpdf
chmod +x cpdf
sudo cp cpdf /usr/local/bin/
 ```
 
