<?php

namespace AppBundle\ExternalDataProviders;

interface ConsumeRawData
{
    public function consume();

    public function formatData();

}