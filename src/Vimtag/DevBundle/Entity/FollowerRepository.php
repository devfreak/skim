<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace Vimtag\DevBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FollowerRepository extends EntityRepository
{
    public function notSeenUrls(User $user)
    {
        return $this
              ->createQueryBuilder('u')
              ->leftJoin('u.history', 'h', 'WITH', 'h.user = :user')
              ->where('h.url IS NULL')
              //->andwhere('h.user = :user')
              ->setParameter('user', $user)
              ->getQuery()
              ->getScalarResult()
        ;
    }
}