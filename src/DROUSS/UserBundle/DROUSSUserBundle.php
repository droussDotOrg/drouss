<?php

namespace DROUSS\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DROUSSUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
