<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomController extends AbstractController
{
    public function isTokenValid($token, $intention)
    {
        if ($token === null) {
            throw $this->createNotFoundException();
        }

        if (!$this->isCsrfTokenValid($intention, $token)) {
            throw $this->createNotFoundException();
        }
    }

    public function em()
    {
        return $em = $this->getDoctrine()->getManager();
    }
}