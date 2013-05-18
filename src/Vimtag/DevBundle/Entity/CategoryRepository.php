<?php
// src/Acme/StoreBundle/Entity/Product.php
namespace Vimtag\DevBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{

    public function getNextCategory(User $user)
    {
    	return $this
    	->createQueryBuilder('u')
    	->orderBy('u.views', 'DESC')
    	->setFirstResult($user->getLastcat()+1)
    	->setMaxResults($user->getLastcat()+1)
    	->getQuery()
    	->getSingleResult()
    	;
    }

    public function countAllCategories()
    {
        return $this
            ->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

}