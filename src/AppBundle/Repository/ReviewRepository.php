<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;


class ReviewRepository extends EntityRepository
{
    public function getRecentReviews($count = 5, $orderBy = 'r.modifyDate', $featured = false)
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('r.reviewId', 'r.productId', 'p.productName', 'r.rating', 'r.memberId',
                'r.originalMemberName', 'r.reviewTitle', 'r.description', 'r.modifyDate')
            ->from('AppBundle:Review', 'r')
            ->innerJoin('AppBundle:Product', 'p',
                Expr\Join::WITH, 'p.productId = r.productId')
            ->where('r.isActive = 1');
        if ($featured) {
            $query->andWhere('r.isFeatured = :featured')
            ->setParameter('featured', boolval($featured));
        }
            $query->orderBy($orderBy, 'DESC')
            ->setMaxResults($count);
        return $query->getQuery()->getResult();
    }

    public function getProductByReviewId($reviewId)
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from('AppBundle:Product', 'p')
            ->innerJoin('AppBundle:Review', 'r',
                Expr\Join::WITH, 'p.productId = r.productId')
            ->where('r.reviewId = :reviewId')
            ->setParameter('reviewId', $reviewId);
        return $query->getQuery()->getResult();
    }
}
