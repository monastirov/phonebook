<?php

namespace Monastyryov\PhoneBookApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;
use Monastyryov\PhoneBookBundle\Service\CityService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route(service="phone_book_api.controller.city")
 */
class CityController extends FOSRestController
{
    /**
     * @var CityService
     */
    protected $cityService;

    /**
     * RecordController constructor.
     * @param CityService $cityService
     */
    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    /**
     * @Route("/phone_book/cities", name="phone_book_api.city.all")
     * @Method({"GET"})
     */
    public function getAll()
    {
        $context = SerializationContext::create()->setGroups(['cities', 'default']);
        $data = $this->cityService->getAll();
        $view = $this->view($data)->setFormat('json');
        $view->setSerializationContext($context);

        return $this->handleView($view);
    }
}
