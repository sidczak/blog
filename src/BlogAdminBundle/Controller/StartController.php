<?php

namespace BlogAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StartController extends Controller
{
    public function indexAction()
    {
        return $this->render('BlogAdminBundle:Start:index.html.twig');
    }
}

