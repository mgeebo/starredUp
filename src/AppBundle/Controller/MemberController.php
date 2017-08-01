<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Member;
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
 *   path="/members"
 * )
 */

class MemberController extends ApiController
{
    /**
     * @SWG\Get(
     *     tags={"members"},
     *     path="/members/{memberId}",
     *     summary="Get a single member by ID",
     *     description="Return JSON object of a single member",
     *     operationId="getMember",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *       name="memberId",
     *       in="path",
     *       description="Member ID of the desired member",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200",
     *       description="Success => [member => {member}]"
     *     ),
     *     @SWG\Response(response="404",
     *       description="No member found for ID: {memberId}"
     *     )
     *   )
     *
     * @Route("/members/{memberId}")
     * @Method({"GET"})
     */

    public function getMember($memberId)
    {
        $em = $this->getDoctrine();


            $member = $em->getRepository(Member::class)->findByMemberId($memberId);

            if (!empty($member))
            {
                $success = ["success" => ["member" => $member[0]]];

                // Serialize array to make it returnable as a string for the Response
                $member = $this->serializer->serialize($success, 'json');
            }
            else
            {
                return new JsonResponse(["No member found for ID: $memberId"], 404);
            }

        return new JsonResponse($member);
    }

    /**
     * @SWG\Post(
     *     tags={"members"},
     *     path="/members/add",
     *     summary="Save or Update a single member with a payload",
     *     description="Return JSON with the effected member ID",
     *     operationId="addMember",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *       name="body",
     *       in="body",
     *       description="Update a member by adding the memberId to the payload",
     *       required=true,
     *       @SWG\Schema(ref="#/definitions/Member")
     *     ),
     *     @SWG\Response(response="200",
     *       description="Success => [memberId => {memberId}]"
     *     ),
     *     @SWG\Response(response="404",
     *       description="No member found for id {memberId}"
     *     )
     *   )
     *
     * @Route("/members/add")
     * @Method({"POST"})
     */

    public function addMember(Request $r) {
        $em = $this->getDoctrine()->getManager();
        $member = new Member();
        $prop = $r->request->all();

        if (!is_null($memberId = $prop['memberId'])) {
            $member = $em->getRepository(Member::class)->find($memberId);
            if (!$member) {
                return new JsonResponse(["No member found for ID: $memberId"], 404);
            }
        }

        $member->setMemberName($prop['memberName'])
            ->setMemberFirstName($prop['memberFirstName'])
            ->setMemberLastName($prop['memberLastName'])
            ->setMemberEmail($prop['memberEmail'])
            ->setMemberPassword($prop['memberPassword'])
            ->setMemberDob($prop['dob'])
            ->setIsActive($prop['isActive']);

        try {
            $em->persist($member);
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
                "memberId" => $member->getMemberId()
            ]
        ]);
    }
    /**
     * @SWG\Post(
     *     tags={"members"},
     *     path="/members/{memberId}/remove",
     *     summary="Deactivate a member",
     *     description="Return JSON object of the effected member and isActive status",
     *     operationId="removeMember",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *       name="memberId",
     *       in="path",
     *       description="The member ID of the member to be deactivated",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200",
     *      description="Success => [memberId => {memberId}, isActive => {isActive}]"
     *     ),
     *      @SWG\Response(response="404",
     *       description="No member found for ID: {memberId}"
     *     ),
     *      @SWG\Response(response="409",
     *       description="Member has already been removed"
     *     )
     * )
     *
     * @Route("/members/{memberId}/remove")
     * @Method({"POST"})
     */

    public function removeMember($memberId) {
        $em = $this->getDoctrine()->getManager();
        if (is_null($member = $em->getRepository(Member::class)->find($memberId))) {
            return new JsonResponse(["No member found for ID: $memberId"], 404);
        }

        if ($member->getIsActive() == false) {
            return new JsonResponse(["Member has already been removed"], 409);
        }

        $member->setIsActive(0);

        try {
            $em->persist($member);
            $em->flush();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return new JsonResponse([
            "success" => [
                "memberId" => $member->getMemberId(),
                "isActive" => $member->getIsActive()
            ]
        ]);
    }
}