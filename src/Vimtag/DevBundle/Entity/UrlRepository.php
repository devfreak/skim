<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace Vimtag\DevBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UrlRepository extends EntityRepository
{
    public function getRandomUrlByCategory(Category $category)
    {
    
        return $this
        ->createQueryBuilder('u')
        ->andWhere('u.category = :category')
        ->andWhere('u.id > :rand')
        ->setMaxResults(1)
        ->setParameter('category', $category->getId())
        ->setParameter('rand', rand(0,5000))
        ->getQuery()
        ->getSingleResult()
        ;


    }
}