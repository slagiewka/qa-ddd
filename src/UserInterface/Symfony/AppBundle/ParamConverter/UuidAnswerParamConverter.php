<?php
declare(strict_types=1);
namespace Brainly\UserInterface\Symfony\AppBundle\ParamConverter;

use Brainly\Domain\Answer;
use Brainly\Domain\Answers;
use Ramsey\Uuid\UuidInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class UuidAnswerParamConverter extends AbstractUuidParamConverter
{
    /** @var Answers */
    private $answers;

    public function __construct(Answers $answers)
    {
        $this->answers = $answers;
    }

    protected function findValue(UuidInterface $uuid)
    {
        return $this->answers->findById($uuid);
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ParamConverter $configuration)
    {
        return Answer::class === $configuration->getClass();
    }
}
