<?php

namespace App\Models;

use CodeIgniter\Model;

class Apimodels extends Model
{
    public function __construct()
    {
        $this->client = \Config\Services::curlrequest();
        $this->curl = "http://127.0.0.1:8022/";
    }
    public function get_api($insert, $linked)
    {

        $url = $this->curl . $linked;
        $output = $this->client->request('GET', $url, [$insert, 'verify' => false]);
        $result = json_decode($output->getBody(), true);
        return $result;
    }
    public function post_api($insert, $linked)
    {
        $url = $this->curl . $linked;
        $output = $this->client->request('POST', $url, [
            'form_params' => $insert,
            'verify' => false
        ]);
        $result = json_decode($output->getBody(), true);
        return $result;
    }
    public function uploadData($validasi, $oldname, $paths, $linked)
    {
        $url = 'https://portal8.isoide.co.id/apilib/' . $linked;

        // Prepare the multipart data
        $postData = [
            'key' => 'adexganteng',
            'data_upload' => new \CURLFile($paths),
            'validasi' => $validasi,
            'oldname' => $oldname,
        ];
        $response = $this->client->post($url, ['debug' => false, 'verify' => false, 'multipart' => $postData]);
        $result = json_decode($response->getBody(), true);
        return $result;
    }
    public function deleteimage($insert, $linked)
    {
        // $url = $this->curl . '/' . $linked;
        $url = 'https://portal8.isoide.co.id/apilib/' . $linked;
        $output = $this->client->request('POST', $url, [
            'form_params' => $insert, 'verify' => false
        ]);
        $result = json_decode($output->getBody(), true);
        return $result;
    }

    // csrftoken = document.querySelector('meta[name="csrf_akmadnudin_com"]').getAttribute('content'),
    //     csrfnama = 'csrf_akmadnudin_com',
    // [csrfnama]: csrftoken,

}
