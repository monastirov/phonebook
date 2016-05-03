<?php

namespace Monastyryov\PhoneBookApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Monastyryov\PhoneBookApiBundle\Form\Type\RecordRequestType;
use Monastyryov\PhoneBookBundle\Entity\Record;
use Monastyryov\PhoneBookBundle\Request\RecordRequest;
use Monastyryov\PhoneBookBundle\Service\RecordService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(service="phone_book_api.controller.record")
 */
class RecordController extends FOSRestController
{
    /**
     * @var RecordService
     */
    protected $recordService;

    /**
     * RecordController constructor.
     * @param RecordService $recordService
     */
    public function __construct(RecordService $recordService)
    {
        $this->recordService = $recordService;
    }

    /**
     * @Route("/phone_book/records", name="phone_book_api.record.all")
     * @Method({"GET"})
     */
    public function getAll()
    {
        $data = $this->recordService->getAll();
        $view = $this->view($data)->setFormat('json');
        return $this->handleView($view);
    }

    /**
     * @Route("/phone_book/records", name="phone_book_api.record.create")
     * @Method({"POST"})
     * @param Request $request
     * @return Response
     */
    public function createRecord(Request $request)
    {
        $record = new RecordRequest();
        $form = $this->createForm(RecordRequestType::class, $record);
        $form->handleRequest($request);

        $view = $this->view()->setFormat('json')->setStatusCode(400);
        if ($form->isValid()) {
            $this->recordService->createRecordByRequest($record);
            $view->setStatusCode(200);
            return $this->handleView($view);
        }

        return $this->handleView($view);
    }
}
