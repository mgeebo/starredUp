<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MemberRepository extends EntityRepository
{
    public function getMemberProfile($memberId) {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('m.memberId, m.memberName, m.profileImage, m.profileMessage, 
            m.email, m.firstName, m.lastName, m.createDate')
            ->from('AppBundle:Member', 'm')
            ->where('m.memberId = :memberId')
            ->andWhere('m.isActive = 1')
            ->setParameter('memberId', $memberId)
            ->getQuery()
            ->getSingleResult();
    }
}
