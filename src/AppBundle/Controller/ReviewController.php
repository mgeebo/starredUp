<?php

namespace AppBundle\Controller;

use Swagger\Annotations as SWG;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use InvalidArgumentException;
use AppBundle\Entity\Review;
use Doctrine\DBAL\Exception\DriverException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

/**
 * @SWG\Path(
 *   path="/reviews"
 * )
 */
class ReviewController extends ApiController
{
    /**
     * @SWG\Get(
     *     tags={"reviews"},
     *     path="/reviews/{reviewId}",
     *     summary="Get a single review by ID",
     *     description="Return JSON object of a single review",
     *     operationId="getReview",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *       name="reviewId",
     *       in="path",
     *       description="Review ID of the desired review",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200",
     *       description="Success => [product => {product}]"
     *     ),
     *     @SWG\Response(response="404",
     *       description="No product found for ID: {productId}"
     *     )
     *   )
     *
     * @Route("/reviews/{reviewId}")
     * @Method({"GET"})
     */
    public function getReview($reviewId)
    {
        $em = $this->getDoctrine();

        try {
            $review = $em->getRepository(Review::class)->findByReviewId($reviewId);
        } catch (InvalidArgumentException $e) {
            return new JsonResponse(["No review found for ID: $reviewId"], 404);
        }

        if (!empty($review)) {
            $success = [
                "success" => [
                    "review" => $review[0]
                ]
            ];
            // Serialize array to make it returnable as a string for the Response
            $review = $this->serializer->serialize($success, 'json');
        }

        return new Response($review);
    }

    /**
     * @SWG\POST(
     *     tags={"reviews"},
     *     path="/reviews/add",
     *     summary="Adds a new review",
     *     description="Adds a new review",
     *     operationId="addReview",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *       name="body",
     *       in="body",
     *       description="Updates a review based on this data",
     *       required=true,
     *       @SWG\Schema(ref="#/definitions/Review")
     *     ),
     *     @SWG\Response(response="200",
     *       description="Success => [review => {review}]"
     *     ),
     *     @SWG\Response(response="404",
     *       description="No review found for ID: {reviewId}"
     *     )
     *   )
     *
     * @Route("/reviews/{reviewsId}")
     * @Method({"POST"})
     */
    public function addReview(Request $r)
    {
        $em = $this->getDoctrine()->getManager();
        $review = new Review();
        $prop = $r->getContent();
        $prop = json_decode($prop, true);

        if (isset($prop['reviewId']) && !is_null($reviewId = $prop['reviewId'])) {
            $review = $em->getRepository(Review::class)->find($reviewId);
            if (!$review) {
                return new JsonResponse(["No review found for ID: $reviewId"], 404);
            }
        }

        $review->setProductId($prop['productId']);
        $review->setMemberId($prop['memberId']);
        $review->setDescription($prop['description']);
        $review->setRating($prop['rating']);
        $review->setOriginalMemberId($prop['originalMemberId']);
        $review->setReviewTitle($prop['reviewTitle']);
        //$review->setIsActive($prop['isActive']);


        try {
            $em->persist($review);
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
                "reviewId" => $review->getReviewId()
            ]
        ]);
    }

    /**
     * @SWG\POST(
     *     tags={"reviews"},
     *     path="/reviews/{reviewId}/remove",
     *     summary="Deactivate a review",
     *     description="Return JSON object of the effected review and isActive status",
     *     operationId="removeReview",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *       name="reviewId",
     *       in="path",
     *       description="The ID of the review to be deactivated",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200",
     *      description="Success => [reviewId => {reviewId}, isActive => {isActive}]"
     *     ),
     *      @SWG\Response(response="404",
     *       description="No review found for ID: {reviewId}"
     *     ),
     *      @SWG\Response(response="409",
     *       description="Review has already been removed"
     *     )
     * )
     *
     * @Route("/reviews/{reviewId}/remove")
     * @Method({"POST"})
     */
    public function removeReview($review)
    {
        return new Response("Product");
    }
}