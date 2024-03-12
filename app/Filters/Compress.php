<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Compress implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        return $this->compressResponse($request);
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $this->compressResponse($response);
    }

    private function compressResponse($response)
    {
        if ($response instanceof ResponseInterface) {
            $contentType = $response->getHeaderLine('Content-Type');
            if (strpos($contentType, 'text/html') !== false) {
                $output = (string) $response->getBody();
                $output = $this->compressMinify($output);
                $response->setBody($output);
            }
        }
        return $response;
    }
    

    private function compressMinify($output)
    {
        // Pola untuk mencari dan menghapus komentar HTML
        $search = [
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        ];
        $replace = [
            '>',
            '<',
            '\\1',
            '' // Tidak ada teks pengganti untuk komentar
        ];
        $output = preg_replace($search, $replace, $output);
        return $output;
    }
}
