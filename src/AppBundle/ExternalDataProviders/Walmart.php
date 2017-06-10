<?php

namespace AppBundle\ExternalDataProviders;

use Unirest;

class Walmart implements ConsumeRawData
{


    public function consume()
    {

        $headers = array('Accept' => 'application/json');
        $query = array('q' => 'Frank sinatra', 'type' => 'track');
        //$response = Unirest\Request::get('http://api.walmartlabs.com/v1/items',$headers,$query);
        // or use a plain text request
        $response = Unirest\Request::get('http://api.walmartlabs.com/v1/items/46708411?format=json&apiKey=ep7npckux5mvje859n62btkz');

        // Display the result
        return $response->body;
    }

    public function formatData()
    {
        // TODO: Implement formatData() method.
    }


}