<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace Vimtag\DevBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserScoreRepository extends EntityRepository
{
    public function getAvailableCategories(User $user)
    {
    	return $this
    	->createQueryBuilder('u')
    	  ->innerJoin('u.category', 'c')
    	  ->leftJoin('c.urls', 'u2', 'WITH', 'u2.category = c.id')
    	  ->leftJoin('u2.history', 'h', 'WITH', 'h.user = :user')
    	  ->where('h.url IS NULL')
        ->andwhere('u.user = :user')
        ->setParameter('user', $user)
        ->getQuery()
        ->getResult()
        ;
    }
}