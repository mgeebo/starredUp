<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;


class ProductRepository extends EntityRepository
{
    public function getRecentProducts($count = 5, $orderBy = 'p.modifyDate', $featured = false)
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('p.productId', 'p.productName', 'p.productDescription', 'p.productRating', 'p.reviewCount',
                'p.productManufacturer', 'p.upc', 'p.productImage', 'p.modifyDate')
            ->from('AppBundle:Product', 'p')
            ->where('p.isActive = 1');
        if ($featured) {
            $query->andWhere('p.isFeatured = :featured')
                ->setParameter('featured', boolval($featured));
        }
        $query->orderBy($orderBy)
            ->setMaxResults($count);
        return $query->getQuery()->getResult();
    }

    public function getProductByProductId($productId)
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from('AppBundle:Product', 'p')
            ->where('p.productId = :productId')
            ->setParameter(':productId', $productId);
        return $query->getQuery()->getResult();
    }
}
