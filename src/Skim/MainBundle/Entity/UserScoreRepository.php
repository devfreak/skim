<?php

namespace Skim\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Skim\MainBundle\Entity\Category;
use Skim\MainBundle\Entity\User;

/**
 * UserScoreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserScoreRepository extends EntityRepository
{

	public function getScoreByCategory(Category $category, $user)
	{
		return $this
			->createQueryBuilder('u')
			->where('u.user = :user')
			->andwhere('u.category = :category')
			->setMaxResults(1)
			->setParameter('user', $user)
			->setParameter('category', $category)
			->getQuery()
			->getSingleResult()
		;
	}

	public function findScoreOfObjectByCategory($object, Category $category)
	{
		return $this
			->createQueryBuilder('u')
			->select('COUNT(u.id)')
			->where('u.user = :user')
			->andwhere('u.category = :category')
			->setMaxResults(1)
			->setParameter('user', $object)
			->setParameter('category', $category)
			->getQuery()
			->getSingleScalarResult()
		;
	}

	public function getHighestScoreOfObject($object)
	{
		return $this
			->createQueryBuilder('u')
			->where('u.user = :user')
			->orderby('u.percentage', 'DESC')
			->setMaxResults(1)
			->setParameter('user', $object)
			->getQuery()
			->getSingleResult()
		;
	}

	public function countScoresFromUser($user)
	{
		return $this
			->createQueryBuilder('u')
			->where('u.user = :user')
			->select('COUNT(u.id)')
			->setParameter('user', $user)
			->getQuery()
			->getSingleScalarResult()
		;
	}

}