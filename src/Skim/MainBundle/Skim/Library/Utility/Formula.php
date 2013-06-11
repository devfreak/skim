<?php

namespace Skim\MainBundle\Skim\Library\Utility;

class Formula
{
	public function getNewPercentage($parent, $child, $parentInterests, $childInterests)
	{
		return

			$child *

			($childInterests / 
				($childInterests + $parentInterests)
			) +

			$parent *

			($parentInterests / 
				($childInterests + $parentInterests)
			)

		;
	}
}