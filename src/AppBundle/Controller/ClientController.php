<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use Doctrine\DBAL\Exception\DriverException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Mapping\Annotation;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

use Swagger\Annotations as SWG;

/**
 * @SWG\Path(
 *   path="/Clients"
 * )
 */

class ClientController extends ApiController
{
    /**
     * @SWG\Get(
     *     tags={"clients"},
     *     path="/clients/{clientId}",
     *     summary="Get a single client by ID",
     *     description="Return JSON object of a single client",
     *     operationId="getClient",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *       name="clientId",
     *       in="path",
     *       description="Client ID of the desired client",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200",
     *       description="Success => [client => {client}]"
     *     ),
     *     @SWG\Response(response="404",
     *       description="No client found for ID: {clientId}"
     *     )
     *   )
     *
     * @Route("/clients/{clientId}")
     * @Method({"GET"})
     */

    public function getClient($clientId)
    {
        $em = $this->getDoctrine();


            $client = $em->getRepository(Client::class)->findByClientId($clientId);

            if (!empty($client))
            {
                $success = ["success" => ["client" => $client[0]]];

                // Serialize array to make it returnable as a string for the Response
                $client = $this->serializer->serialize($success, 'json');
            }
            else
            {
                return new JsonResponse(["No client found for ID: $clientId"], 404);
            }

        return new JsonResponse($client);
    }

    /**
     * @SWG\Post(
     *     tags={"clients"},
     *     path="/clients/add",
     *     summary="Save or Update a single client with a payload",
     *     description="Return JSON with the effected client ID",
     *     operationId="addClient",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *       name="body",
     *       in="body",
     *       description="Update a client by adding the clientId to the payload",
     *       required=true,
     *       @SWG\Schema(ref="#/definitions/Client")
     *     ),
     *     @SWG\Response(response="200",
     *       description="Success => [clientId => {clientId}]"
     *     ),
     *     @SWG\Response(response="404",
     *       description="No client found for id {clientId}"
     *     )
     *   )
     *
     * @Route("/clients/add")
     * @Method({"POST"})
     */

    public function addClient(Request $r) {
        $em = $this->getDoctrine()->getManager();
        $client = new Client();
        $prop = $r->request->all();

        if (!is_null($clientId = $prop['clientId'])) {
            $client = $em->getRepository(Client::class)->find($clientId);
            if (!$client) {
                return new JsonResponse(["No client found for ID: $clientId"], 404);
            }
        }

        $client->setClientName($prop['clientName'])
            ->setClientName($prop['clientName'])
            ->setClientPassword($prop['clientPassword'])
            ->setIsActive($prop['isActive']);

        try {
            $em->persist($client);
            $em->flush();
        } catch (ORMInvalidArgumentException $e) {
            echo $e->getMessage();
        } catch (UniqueConstraintViolationException $e) {
            echo $e->getMessage();
        } catch (DriverException $e) {
            echo $e->getMessage();
        } catch (ORMException $e) {
            echo $e->getMessage();
        }

        return new JsonResponse([
            "success" => [
                "clientId" => $client->getClientId()
            ]
        ]);
    }
    /**
     * @SWG\Post(
     *     tags={"clients"},
     *     path="/clients/{clientId}/remove",
     *     summary="Deactivate a client",
     *     description="Return JSON object of the effected client and isActive status",
     *     operationId="removeClient",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *       name="clientId",
     *       in="path",
     *       description="The client ID of the client to be deactivated",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200",
     *      description="Success => [clientId => {clientId}, isActive => {isActive}]"
     *     ),
     *      @SWG\Response(response="404",
     *       description="No client found for ID: {clientId}"
     *     ),
     *      @SWG\Response(response="409",
     *       description="Client has already been removed"
     *     )
     * )
     *
     * @Route("/clients/{clientId}/remove")
     * @Method({"POST"})
     */
    public function removeClient($clientId) {
        $em = $this->getDoctrine()->getManager();
        if (is_null($client = $em->getRepository(Client::class)->find($clientId))) {
            return new JsonResponse(["No client found for ID: $clientId"], 404);
        }

        if ($client->getIsActive() == false) {
            return new JsonResponse(["Client has already been removed"], 409);
        }

        $client->setIsActive(0);

        try {
            $em->persist($client);
            $em->flush();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return new JsonResponse([
            "success" => [
                "clientId" => $client->getClientId(),
                "isActive" => $client->getIsActive()
            ]
        ]);
    }
}