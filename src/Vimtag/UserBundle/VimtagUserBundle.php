<?php

namespace Vimtag\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VimtagUserBundle extends Bundle
{

	public function getParent()
	{
		return 'FOSUserBundle';
	}

}
