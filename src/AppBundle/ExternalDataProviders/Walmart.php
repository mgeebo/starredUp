<?php

namespace AppBundle\ExternalDataProviders;

use Unirest;

class Walmart implements ConsumeRawData
{

    /** Example Data
     *
     * $response = Unirest\Request::get('http://api.walmartlabs.com/v1/items/46708411?format=json&apiKey=ep7npckux5mvje859n62btkz');
     *http://api.walmartlabs.com/v1/reviews/46708411?format=json&apiKey=ep7npckux5mvje859n62btkz

     */

    CONST URL = "http://api.walmartlabs.com/v1/reviews/";

    public function authenticate()
    {

    }


    public function consume()
    {
        $item_id = 46708411;

        $headers = array('Accept' => 'application/json');
        $query = array('format' => '', 'type' => 'track');
        //$response = Unirest\Request::get('http://api.walmartlabs.com/v1/items',$headers,$query);
        // or use a plain text request
        $response = Unirest\Request::get(URL,$item_id?format=json&apiKey=ep7npckux5mvje859n62btkz);

        // Display the result
        return $response->body;
    }

    public function formatData()
    {
        // TODO: Implement formatData() method.
    }
}