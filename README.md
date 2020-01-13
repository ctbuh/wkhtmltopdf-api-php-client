# wkhtmltopdf-api-php-client


`composer require ctbuh\wkhtmltopdf-api-php-client`


### API

 - `convert($bytes, $options = array())`
 - `inline($bytes, $options = array(), $filename = 'document.pdf')`
 - `download($bytes, $options = array(), $filename = 'document.pdf')`
 
 ### Examples
 
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
 
 
