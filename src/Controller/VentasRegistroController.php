<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VentasRegistroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

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
     * @Route("/api/ventasregistros/", name="add_ventasRegistros", methods={"POST"})
     */
    public function addVentasRegistro(Request $request): JsonResponse
    {
        try{
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
        }catch(Throwable $exception){
            return new JsonResponse(['status' => 'Error en los datos -- '.$exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse(['status' => 'VentasRegistro created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/api/ventasregistros/{id}", name="get_one_ventasRegistros", methods={"GET"})
     */
    public function getOneVentasRegistro($id): JsonResponse
    {
        try{
            $ventasRegistros = $this->ventasRegistroRepository->findOneBy(['id' => $id]);

            $data = [
                'id' => $ventasRegistros->getId(),
                'clientName' => $ventasRegistros->getClientName(),
                'dateAdd' => $ventasRegistros->getDateAdd(),
                'friendName' => $ventasRegistros->getfriendName(),
                'deliveryAddress' => $ventasRegistros->getDeliveryAddress(),
                'deliveryDate' => $ventasRegistros->getDeliveryDate(),
                'ammount' => $ventasRegistros->getAmmount(),
                'phoneNumber' => $ventasRegistros->getPhoneNumber(),
                'status' => $ventasRegistros->getStatus(),
            ];
        }catch(Throwable $exception){
            return new JsonResponse(['status' => 'Error recuperando datos -- '.$exception->getMessage()], Response::HTTP_NO_CONTENT);    
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/ventasregistros/", name="get_all_ventasRegistros", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        try{
            $ventasRegistros = $this->ventasRegistroRepository->findAll();
            $data = [];

            foreach ($ventasRegistros as $ventasRegistro) {
                $data[] = [
                    'id' => $ventasRegistro->getId(),
                    'clientName' => $ventasRegistro->getClientName(),
                    'dateAdd' => $ventasRegistro->getDateAdd(),
                    'friendName' => $ventasRegistro->getfriendName(),
                    'deliveryAddress' => $ventasRegistro->getDeliveryAddress(),
                    'deliveryDate' => $ventasRegistro->getDeliveryDate(),
                    'ammount' => $ventasRegistro->getAmmount(),
                    'phoneNumber' => $ventasRegistro->getPhoneNumber(),
                    'status' => $ventasRegistro->getStatus(),
                ];
            }
        }catch(Throwable $exception){
            return new JsonResponse(['status' => 'Error recuperando datos -- '.$exception->getMessage()], Response::HTTP_NO_CONTENT);    
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    
}