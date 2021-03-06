<?php

namespace Skim\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Skim\MainBundle\Entity\User;

/**
 * FollowerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FollowerRepository extends EntityRepository
{

	public function getFollowingOfFollower(User $following, User $follower)
	{
		return $this
			->createQueryBuilder('f')
			->where('f.following = :following')
			->andwhere('f.follower = :follower')
			->setMaxResults(1)
			->setParameter('following', $following)
			->setParameter('follower', $follower)
			->getQuery()
			->getSingleResult()
		;
	}

}
