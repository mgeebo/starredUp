<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Member;
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
            $success = $review[0];
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

        $member = $em->getRepository(Member::class)->findOneByMemberId($prop['memberId']);
        if(isset($member)) {
            $review->setMemberName($member->getMemberName());
        }

        $review->setDescription($prop['description']);
        $review->setRating($prop['rating']);
        // prop doesn't exist when adding from starredUp
        if (isset($prop['originalMemberId'])) {
            $review->setOriginalMemberId($prop['originalMemberId']);
        }
        $review->setReviewTitle($prop['reviewTitle']);

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
    public function removeReview($reviewId)
    {
        $em = $this->getDoctrine()->getManager();
        if (is_null($review = $em->getRepository(Review::class)->find($reviewId))) {
            return new JsonResponse(["No review found for ID: $reviewId"], 404);
        }

        if ($review->getIsActive() == false) {
            return new JsonResponse(["Review has already been removed"], 409);
        }

        $review->setIsActive(0);

        try {
            $em->persist($review);
            $em->flush();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return new JsonResponse([
                "reviewId" => $review->getreviewId(),
                "isActive" => $review->getIsActive()
        ]);
    }

    /**
     * @Route("/reviews/component/recentReviews")
     * @Method({"GET"})
     */
    public function getRecentReviews() {
        $em = $this->getDoctrine();
        $reviewRepository = $em->getRepository(Review::class);
        $recentReviews = $this->serializer->serialize($reviewRepository->getRecentReviews(), 'json');
        return new Response($recentReviews);
    }

    /**
     * @Route("/reviews/component/featuredReviews")
     * @Method({"GET"})
     */
    public function getFeaturedReviews() {
        $count = 5;
        $orderBy = 'r.isFeatured';
        $em = $this->getDoctrine();
        $reviewRepository = $em->getRepository(Review::class);
        $recentReviews = $this->serializer->serialize($reviewRepository->getRecentReviews($count, $orderBy, true), 'json');
        return new Response($recentReviews);
    }

    /**
     * @Route("/reviews/util/productByReviewId/{reviewId}")
     * @Method({"GET"})
     */
    public function getProductByReviewId($reviewId) {
        $em = $this->getDoctrine();
        $reviewRepository = $em->getRepository(Review::class);
        $product = $this->serializer->serialize($reviewRepository->getProductByReviewId($reviewId), 'json');
        return new Response($product);
    }
}