<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace Vimtag\DevBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function getNewestUrlOfFollowers(User $user)
    {
        return $this
              ->createQueryBuilder('u')
              ->leftJoin('u.following', 'f')
              ->leftJoin('f.following', 'following')
              ->leftJoin('following.urls', 'urls')
              ->orderBy('urls.id', 'DESC')
              ->where('u.id = :user')
              ->setMaxResults(1)
              //->where('h.url IS NULL')
              //->andwhere('h.user = :user')
              ->setParameter('user', $user->getId())
              ->getQuery()
              ->getScalarResult()
        ;
    }
}