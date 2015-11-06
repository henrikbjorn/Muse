<?php

namespace Muse\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    public function indexAction()
    {
        return $this->render('@Muse/Default/index.html.twig');
    }
}
