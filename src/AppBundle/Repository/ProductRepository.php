<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

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
}
