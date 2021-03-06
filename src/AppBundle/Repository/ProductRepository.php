<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

class ProductRepository extends EntityRepository
{
    public function getProductSearchResults($searchString)
    {
        $searchString = '%' . $searchString . '%';
        return $this->getEntityManager()->createQueryBuilder()
            ->select('p.productId, p.productName, p.productManufacturer, p.productRating, p.productImage, p.productCategory, p.isFeatured')
            ->from('AppBundle:Product', 'p')
            ->where('p.productName LIKE :searchString')
            ->andWhere('p.isActive = 1')
            ->setParameter('searchString', $searchString)
            ->orderBy('p.productName', 'desc')
            ->getQuery()
            ->getResult();
    }

    public function getAllProducts()
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from('AppBundle:Product', 'p')
            ->where('p.isActive = 1');
        return $query->getQuery()->getResult();
    }


    public function getReviewsByProductId($productId)
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('r')
            ->from('AppBundle:Review', 'r')
            ->innerJoin('AppBundle:Product', 'p',
                Expr\Join::INNER_JOIN, 'p.productId = r.productId')
            ->where('r.productId = :productId')
            ->andWhere('r.isActive = 1')
            ->setParameter('productId', $productId);
        return $query->getQuery()->getResult();
    }
}
