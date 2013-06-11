<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace Vimtag\DevBundle\Entity;

use Doctrine\ORM\EntityRepository;

class HistoryRepository extends EntityRepository
{
    public function getLastUrl(User $user)
    {
        return $this
            ->createQueryBuilder('u')
            ->where('user = :user')
            ->orderby('id','DESC')
            ->setMaxResults(1)
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleResult()
        ;

    }
}