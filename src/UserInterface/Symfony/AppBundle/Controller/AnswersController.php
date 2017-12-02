<?php
declare(strict_types=1);
namespace Brainly\UserInterface\Symfony\AppBundle\Controller;

use Brainly\Domain\Answer;
use Brainly\Domain\Answers;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;

class AnswersController extends FOSRestController
{
    /** @var Answers */
    private $answers;

    public function __construct(Answers $answers)
    {
        $this->answers = $answers;
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Return all available answers.",
     *  statusCodes={
     *      200="Returned when successful",
     *  }
     * )
     *
     * @return Response
     */
    public function getAnswersAction(): Response
    {
        $data = $this->answers->all();

        $view = $this->view($data)->setContext((new Context())->setGroups(['answers']));

        return $this->handleView($view);
    }

    /**
     * @ApiDoc(
     *  description="Return single answer.",
     *  requirements={
     *      {
     *          "name"="answer",
     *          "dataType"="uuid",
     *          "requirement"="uuid",
     *          "description"="Answer's UUID"
     *      }
     *  },
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when the request parameters are invalid",
     *      404="Returned when the answer was not found"
     *  }
     * )
     *
     * @param Answer $answer
     *
     * @return Response
     */
    public function getAnswerAction(Answer $answer): Response
    {
        $view = $this->view($answer)->setContext((new Context())->setGroups(['answers']));

        return $this->handleView($view);
    }
}
