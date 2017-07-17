<?php

use AppBundle\AppBundle;
use AppBundle\Entity\ExternalProviderProcessedData;
use AppBundle\Entity\ExternalProviderRawData;
use AppBundle\Entity\ExternalProvider;
use AppBundle\Entity\Product;
use AppBundle\Model\ExternalDataProviders\ConsumeRawData;
use AppBundle\Repository\ExternalProviderProductRawDataRepository;
use AppBundle\Repository\ExternalProviderRepository;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Service\ExternalProviderService;
use Monolog\Logger;
use Unirest;

class Ebay implements ConsumeRawData
{

    public function authenticate()
    {
        // TODO: Implement authenticate() method.
    }

    public function consume($itemIds)
    {
        // TODO: Implement consume() method.
    }

    public function processData($data)
    {
        // TODO: Implement processData() method.
    }
}