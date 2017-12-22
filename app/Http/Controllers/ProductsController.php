<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    private $api_url;

    public function __construct()
    {
        $this->api_url = 'https://'.env('SHOPIFY_API_KEY').':'.env('SHOPIFY_PASSWORD').'@lemundo4all.myshopify.com/admin/';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();

        $url = $this->api_url.'products.json';

        $result = $client->request('GET', $url);

        $resultArray = json_decode($result->getBody(), true);

        $productsArray = $resultArray['products'];

        return view('products.index', ["productsArray" => $productsArray]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = $this->api_url."products/$id.json";
        $client = new Client();

        $result = $client->request('GET', $url);

        $resultArray = json_decode($result->getBody(), true);

        $productArray = $resultArray["product"];

        return view('products.show', ["productArray" => $productArray]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $url = $this->api_url."products/$id.json";
        $client = new Client();

        $result = $client->request('GET', $url);

        $resultArray = json_decode($result->getBody(), true);

        $productArray = $resultArray["product"];

        return view('products.edit', ["productArray" => $productArray]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $variantsPrices = $request->price;

        $variantsArray = [];
        foreach($variantsPrices as $variant_id => $price){
            $variantsArray[] = [
                'id' => $variant_id,
                'price' => $price
                ];
        }

        $client = new Client();
        $url = $this->api_url."products/$id.json";

        $response = $client->put($url, [
            RequestOptions::JSON =>[
                'product' =>
                [
                    'id' =>  $id,
                    'title' => $request->title,
                    'variants' => $variantsArray
                ]
            ]
        ]);

        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
