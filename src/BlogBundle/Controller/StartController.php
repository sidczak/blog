<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StartController extends Controller
{
    public function indexAction()
    {
        return $this->render('BlogBundle:Start:index.html.twig');
    }
}

