<?php
declare(strict_types=1);
namespace Brainly\UserInterface\Symfony\AppBundle\Controller;

use Brainly\Application\Command\AnswerQuestionCommand;
use Brainly\Application\Command\AskQuestionCommand;
use Brainly\Application\Command\Command;
use Brainly\Application\CommandBus;
use Brainly\Domain\Question;
use Brainly\Domain\Questions;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class QuestionsController extends AbstractResourceController
{
    /** @var CommandBus */
    private $commandBus;

    /** @var Questions */
    private $questions;

    /** @var ValidatorInterface */
    private $validator;

    public function __construct(CommandBus $commandBus, Questions $questions, ValidatorInterface $validator)
    {
        $this->commandBus = $commandBus;
        $this->questions = $questions;
        $this->validator = $validator;
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Return all available questions.",
     *  statusCodes={
     *      200="Returned when successful",
     *  }
     * )
     *
     * @return Response
     */
    public function getQuestionsAction(): Response
    {
        $questions = $this->questions->all();

        $view = $this->createContextDependentView($questions, 'questions');

        return $this->handleView($view);
    }

    /**
     * @ApiDoc(
     *  description="Return question with answers.",
     *  requirements={
     *      {
     *          "name"="question",
     *          "dataType"="uuid",
     *          "requirement"="uuid",
     *          "description"="Questions's UUID"
     *      }
     *  },
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when the request parameters are invalid",
     *      404="Returned when the question was not found"
     *  }
     * )
     *
     * @param Question $question
     *
     * @return Response
     */
    public function getQuestionAction(Question $question): Response
    {
        $view = $this->createContextDependentView($question, 'single_question');

        return $this->handleView($view);
    }

    /**
     * @ApiDoc(
     *  description="Add new question.",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when input data is invalid"
     *  }
     * )
     * @RequestParam(name="content", nullable=false, strict=true, description="Question's content.")
     *
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function postQuestionsAction(ParamFetcher $paramFetcher): Response
    {
        $id = Uuid::uuid4();
        $askQuestionCommand = new AskQuestionCommand($id, $paramFetcher->get('content'));

        return $this->handleCommand($askQuestionCommand);
    }

    /**
     * @ApiDoc(
     *  description="Add answer to a question question.",
     *  requirements={
     *      {
     *          "name"="question",
     *          "dataType"="uuid",
     *          "requirement"="uuid",
     *          "description"="Questions's UUID"
     *      }
     *  },
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when input data is invalid",
     *      404="Returned when the question was not found"
     *  }
     * )
     *
     * @RequestParam(name="content", nullable=false, strict=true, description="Answer's content.")
     *
     * @param Question     $question
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function postQuestionAnswersAction(Question $question, ParamFetcher $paramFetcher): Response
    {
        $id = Uuid::uuid4();
        $answerQuestionCommand = new AnswerQuestionCommand($id, $question, $paramFetcher->get('content'));

        return $this->handleCommand($answerQuestionCommand);
    }

    /**
     * @ApiDoc(
     *  description="Get answers for a question.",
     *  requirements={
     *      {
     *          "name"="question",
     *          "dataType"="uuid",
     *          "requirement"="uuid",
     *          "description"="Questions's UUID"
     *      }
     *  },
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when the request parameters are invalid",
     *      404="Returned when the question was not found"
     *  }
     * )
     *
     * @param Question $question
     *
     * @return Response
     */
    public function getQuestionAnswersAction(Question $question): Response
    {
        $view = $this->createContextDependentView($question->answers(), 'single_question');

        return $this->handleView($view);
    }

    private function validate($value): array
    {
        $errors = [];
        /** @var ConstraintViolationInterface $violation */
        foreach ($this->validator->validate($value) as $violation) {
            $errors[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        return $errors;
    }

    private function handleCommand(Command $command): Response
    {
        $errors = $this->validate($command);

        return count($errors)
            ? $this->handleErrorResponse($errors)
            : $this->executeCommand($command)
        ;
    }

    private function executeCommand(Command $command): Response
    {
        $this->commandBus->handle($command);

        return $this->handleView($this->view(['id' => $command->uuid()->toString()], Response::HTTP_OK));
    }

    private function handleErrorResponse(array $errors): Response
    {
        return $this->handleView($this->view(['errors' => $errors], Response::HTTP_BAD_REQUEST));
    }
}
