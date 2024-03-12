<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OdooIntegrationController extends Controller
{
    public function showProducts()
    {
        // Odoo server information
        $odooUrl = 'https://oussaamax.odoo.com/';
        $odooDb = 'oussaamax';
        $odooUsername = 'ou2ssamaarfaoui002@gmail.com';
        $odooPassword = 'ou2ssamaarfaoui002';

        // Create a Guzzle HTTP client
        $client = new Client([
            'base_uri' => $odooUrl . '/jsonrpc',
            'auth' => [$odooUsername, $odooPassword],
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'verify' => false, // Disable SSL verification (not recommended for production)
        ]);

        try {
            // Call Odoo API to retrieve products
            $response = $client->post('', [
                'json' => [
                    'jsonrpc' => '2.0',
                    'method' => 'call',
                    'params' => [
                        'model' => 'product.template',
                        'method' => 'search_read',
                        'args' => [[['active', '=', true]]],
                        'kwargs' => [
                            'fields' => ['id', 'name', 'list_price'],
                            'limit' => 10,
                        ],
                    ],
                    'id' => rand(),
                ],
            ]);

            // Parse response JSON
            $odooproducts = json_decode($response->getBody()->getContents(), true);
   
            // Return the Productsodoolist view with the retrieved products
            return view('frontend.pages.odoo.Productsodoolist', ['products' => $odooproducts]);
        } catch (\Exception $e) {
            // Handle request errors
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], 500);
        }
    }
}
