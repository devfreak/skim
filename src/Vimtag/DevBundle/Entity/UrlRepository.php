<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace Vimtag\DevBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UrlRepository extends EntityRepository
{
    public function getRandomUrlByCategory(Category $category, CategoryRepository $repository, User $user)
    {
        return $this
            ->createQueryBuilder('u')
            ->leftJoin('u.history', 'h', 'WITH', 'h.user = :user')
            ->andWhere('u.category = :category')
            ->andwhere('h.url IS NULL')
            ->setFirstResult(rand(0,$this->countAllProducts($category, $user)-1))
            ->setMaxResults(1)
            ->setParameter('category', $category->getId())
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleResult()
        ;

    }

    public function countAllProducts(Category $category, User $user)
    {
        return $this
            ->createQueryBuilder('u')
            ->leftJoin('u.history', 'h', 'WITH', 'h.user = :user')
            ->select("COUNT(u.id)")
            ->andWhere('u.category = :category')
            ->andwhere('h.url IS NULL')
            ->setParameter('category', $category->getId())
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function getNewestUrlOfFollowers(User $user)
    {
        return $this
              ->createQueryBuilder('u')
              ->innerJoin('u.user', 'f')
              ->innerJoin('f.followers', 'ff', 'WITH', 'ff.follower = :user')
              ->leftJoin('u.history', 'h', 'WITH', 'h.user = :user')
              ->orderBy('u.id', 'DESC')
              ->setMaxResults(1)
              ->where('h.url IS NULL')
              ->setParameter('user', $user)
              ->getQuery()
              ->getSingleResult()
        ;
    }
}