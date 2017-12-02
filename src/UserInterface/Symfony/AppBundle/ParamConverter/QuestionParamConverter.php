<?php
declare(strict_types=1);
namespace Brainly\UserInterface\Symfony\AppBundle\ParamConverter;

use Brainly\Domain\Question;
use Brainly\Domain\Questions;
use Ramsey\Uuid\Uuid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class QuestionParamConverter implements ParamConverterInterface
{
    /** @var Questions */
    private $questions;

    public function __construct(Questions $questions)
    {
        $this->questions = $questions;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $name = $configuration->getName();

        if (!$request->attributes->has($name)) {
            return false;
        }

        $value = $request->attributes->get($name);
        $questionId = Uuid::fromString($value);
        $question = $this->questions->findById($questionId);

        if (!$question instanceof Question) {
            throw new NotFoundHttpException(sprintf('Question of ID %s was not found', $questionId));
        }

        $request->attributes->set($name, $question);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ParamConverter $configuration)
    {
        return Question::class === $configuration->getClass();
    }
}
