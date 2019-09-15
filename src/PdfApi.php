<?php

namespace ctbuh\PdfApi;

class PdfApi
{
    /**
     * Just 'password'
     * @var array
     */
    private $options;

    /**
     * PdfApi constructor.
     * @param array $options
     */
    public function __construct($options = array())
    {
        $this->options = $options;
    }

    /**
     * https://www.api2pdf.com/documentation/advanced-options-wkhtmltopdf/
     * @param $input
     * @param array $options
     * @param bool $raw_response
     * @return mixed|null
     */
    public function convert($input, $options = array(), $raw_response = false)
    {
        $params = array(
            'html_base64' => base64_encode($input),
            'options' => $options
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://wkhtmltopdf.api.ctbuh.org/v1/convert");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // some PDFs will take a while to generate
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300); // default
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // no timeout is default

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Cache-Control: no-cache",
            'Content-Type: application/x-www-form-urlencoded'
        ));

        $pdf_response = curl_exec($ch);

        /*
        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error_str = curl_error($ch);
        */

        curl_close($ch);

        $json = json_decode($pdf_response, true);

        if (is_array($json)) {
            return base64_decode($json['pdf_base64']);
        }

        return null;
    }

    public function inline($input, $options = array(), $filename = 'document.pdf')
    {
        $pdf_bytes = $this->convert($input, $options);

        if ($pdf_bytes) {

            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $filename . '"');

            echo $pdf_bytes;
        }
    }

    public function download($input, $options = array(), $filename = 'document.pdf')
    {
        $pdf_bytes = $this->convert($input, $options);

        if ($pdf_bytes) {

            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            echo $pdf_bytes;
        }
    }
}
