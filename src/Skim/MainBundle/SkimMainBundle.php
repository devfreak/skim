<?php

namespace Skim\MainBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SkimMainBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
