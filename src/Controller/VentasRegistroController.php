<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VentasRegistroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class VentasRegistroSiteController
 * @package App\Controller
 *
 *
 */
class VentasRegistroController extends AbstractController
{
    private $ventasRegistroRepository;

    public function __construct(VentasRegistroRepository $ventasRegistroRepository)
    {
        $this->ventasRegistroRepository = $ventasRegistroRepository;
    }

    /**
     * @Route("/api/ventasregistro/", name="add_ventasregistro", methods={"POST"})
     */
    public function addVentasRegistro(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $clientName = $data['clientName'];
        $dateAdd =$data['dateAdd'];
        $friendName = $data['friendName'];
        $deliveryAddress = $data['deliveryAddress'];
        $deliveryDate = $data['deliveryDate'];
        $ammount = $data['ammount'];
        $phoneNumber = $data['phoneNumber'];
        $status = $data['status'];

        if (empty($clientName) || empty($friendName) || empty($deliveryAddress) || empty($phoneNumber)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->ventasRegistroRepository->saveVentasRegistro($clientName, $dateAdd, $friendName, $deliveryAddress, $deliveryDate, $ammount, $phoneNumber, $status);

        return new JsonResponse(['status' => 'VentasRegistro created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/api/ventasregistro/{id}", name="get_one_ventasregistro", methods={"GET"})
     */
    public function getOneVentasRegistro($id): JsonResponse
    {
        $ventasregistro = $this->ventasRegistroRepository->findOneBy(['id' => $id]);

        $data = [
            'id' => $ventasregistro->getId(),
            'clientName' => $ventasregistro->getClientName(),
            'dateAdd' => $ventasregistro->getDateAdd(),
            'friendName' => $ventasregistro->getfriendName(),
            'deliveryAddress' => $ventasregistro->getDeliveryAddress(),
            'deliveryDate' => $ventasregistro->getDeliveryDate(),
            'ammount' => $ventasregistro->getAmmount(),
            'phoneNumber' => $ventasregistro->getPhoneNumber(),
            'status' => $ventasregistro->getStatus(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }
}