<?php

namespace AppBundle\ExternalDataProviders;

interface ConsumeRawData
{
    public function authenticate();
    public function consume();
    public function formatData();

}