<?php

namespace Vimtag\DevBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VimtagDevBundle extends Bundle
{

	public function getParent()
	{
		return 'FOSUserBundle';
	}

}