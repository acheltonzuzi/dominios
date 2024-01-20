<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DomainController extends Controller
{
    function pesquisar(Request $request)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://domainr.p.rapidapi.com/v2/status?mashape-key=' . env('RAPIDAPI_KEY') . '&domain=' . $request->dominio, [
            'headers' => [
                'X-RapidAPI-Host' => 'domainr.p.rapidapi.com',
                'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
            ],
        ]);

        //echo $response->getBody();
        $jsonString = $response->getBody();

        $data = json_decode($jsonString, true);  // Decode the JSON string into an associative array

        $status = $data['status'][0]['status'];  // Access the "status" value within the nested array

        //echo "The status is: $status";  // Output the extracted status
        if($status!=='active'){
            echo 'disponivel';
        }
        else{
            echo 'activo';
        }
    }
}
