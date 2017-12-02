<?php
declare(strict_types=1);
namespace Brainly\UserInterface\Symfony\AppBundle\ParamConverter;

use Brainly\Domain\Question;
use Brainly\Domain\Questions;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UuidQuestionParamConverter extends AbstractUuidParamConverter
{
    /** @var Questions */
    private $questions;

    public function __construct(Questions $questions)
    {
        $this->questions = $questions;
    }

    protected function findValue(UuidInterface $uuid)
    {
        return $this->questions->findById($uuid);
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ParamConverter $configuration)
    {
        return Question::class === $configuration->getClass();
    }
}
