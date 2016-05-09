<?php

namespace Monastyryov\PhoneBookApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;
use Monastyryov\PhoneBookApiBundle\Form\Type\RecordRequestType;
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
        $context = SerializationContext::create()->setGroups(['records', 'default']);
        $data = $this->recordService->getAll();
        $view = $this
            ->view($data)
            ->setFormat('json')
            ->setSerializationContext($context);
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

    /**
     * @Route("/phone_book/records/{id}", name="phone_book_api.record.update")
     * @Method({"PUT"})
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function updateRecord($id, Request $request)
    {
        $record = new RecordRequest();
        $form = $this->createForm(RecordRequestType::class, $record, ['method' => 'PUT']);
        $form->handleRequest($request);
        $view = $this->view()->setFormat('json')->setStatusCode(400);
        if ($form->isValid()) {
            $record->setId($id);
            $this->recordService->updateRecord($record);
            $view->setStatusCode(200);
            return $this->handleView($view);
        }

        return $this->handleView($view);
    }

    /**
     * @Route("/phone_book/records/{id}", name="phone_book_api.record.delete")
     * @Method({"DELETE"})
     * @param int $id
     * @return Response
     */
    public function deleteRecord($id)
    {
        $view = $this->view()
            ->setFormat('json')
            ->setStatusCode(200);

        $this->recordService->deleteRecord($id);
        return $this->handleView($view);
    }
}
