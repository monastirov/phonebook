<?php

namespace Monastyryov\PhoneBookWebBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(service="phone_book_web.controller.main")
 */
class MainController extends Controller
{
    /**
     * @Route("/", name="phone_book_web.main.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@PhoneBookWeb/phonebook/index.html.twig', []);
    }
}

