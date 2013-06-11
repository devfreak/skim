<?php

namespace Skim\MainBundle\Skim\Library\Utility;

use Doctrine\ORM\EntityManager;
use Skim\MainBundle\Entity\User;

class Exchange
{

	private $parent;
	private $parentInterests;
	private $child;
	private $childInterests;
	private $em;
	private $user;
	private $childRepository;
	private $childObject;
	private $childInstance;


	public function setParent($parent, $interests)
	{
		$this->parent = $parent;
		$this->parentInterests = $interests;
		return $this;
	}

	public function setChild($child, $interests)
	{
		$this->child = $child;
		$this->childInterests = $interests;
		return $this;
	}

	public function setEntityManager(EntityManager $em)
	{
		$this -> em = $em;
		return $this;
	}

	public function setChildInstance($instance)
	{
		$this->childInstance = $instance;
		return $this;
	}

	public function setChildRepository($repository)
	{
		$this->childRepository = $repository;
		return $this;
	}

	public function setChildObject($object)
	{
		$this->childObject = $object;
		return $this;
	}

	public function execute()
	{
		$formula = new Formula;
		foreach($this->parent as $object)
		{
			if($object->getPercentage() > 3)
			{
				try 
				{

					$result = $this
						->childRepository
						->findScoreOfObjectByCategory($this->childObject, $object->getCategory())
					;

		        }
			    catch(\Doctrine\ORM\NoResultException $e) 
			    {
			        $result = 0;
			    }

				if($result > 0)
				{
					$child = $this
						->childRepository
						->getScoreByCategory($object->getCategory(), $this->childObject)
					;
					$child
						->setPercentage(
							$formula->getNewPercentage(
								$object->getPercentage(),
								$child->getPercentage(),
								$this->parentInterests,
								$this->childInterests
							)
						)
					;
				}
				else
				{
					$child = $this->childInstance;

					$child
						->setObject($this->childObject)
						->setCategory($object->getCategory())
						->setPercentage(
							$formula->getNewPercentage(
								$object->getPercentage(),
								0,
								$this->parentInterests,
								$this->childInterests
							)
						)
					;

					$this
						->em
						->persist($child)
					;

					$object
						->setPercentage(
							$formula->getNewPercentage(
								0,
								$object->getPercentage(),
								$this->childInterests,
								$this->parentInterests
							)
						)
					;
				}
			}
			else
			{
				$this->em->remove($object);
			}
		}
	}

	public function getResult()
	{
		return $this->child;
	}

}