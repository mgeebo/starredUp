<?php

namespace AppBundle\Providers\ExternalDataProviders;

use AppBundle\Entity\ExternalProviderProductRawData;
use AppBundle\Entity\Product;

interface ConsumeRawData
{
    public function authenticate();
    public function consume($itemIds);
    public function processProducts($data);
    public function processReviews(array $ids);

}