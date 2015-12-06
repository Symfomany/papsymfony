<?php

namespace PaP\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class MainController
 * @package PaP\BackBundle\Controller
 */
class MainController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        return $this->render('BackBundle:Main:index.html.twig');
    }
}
