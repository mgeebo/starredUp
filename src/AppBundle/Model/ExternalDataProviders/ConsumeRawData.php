<?php

namespace AppBundle\Model\ExternalDataProviders;

interface ConsumeRawData
{
    public function authenticate();
    public function consume($itemIds);
    public function processData($data);

}