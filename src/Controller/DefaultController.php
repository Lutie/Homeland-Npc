<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends CustomController
{
    /**
     * @Route()
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
}
