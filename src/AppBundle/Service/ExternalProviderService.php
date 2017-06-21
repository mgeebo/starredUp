<?php

namespace AppBundle\Service;

use AppBundle\Entity\ExternalProviderRawData;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\Tests\Service;

class ExternalProviderService
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }



}