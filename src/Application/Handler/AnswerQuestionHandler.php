<?php
declare(strict_types=1);
namespace Brainly\Application\Handler;

use Brainly\Application\Answer\Factory;
use Brainly\Application\Command\AnswerQuestionCommand;
use Brainly\Domain\Answers;

class AnswerQuestionHandler
{
    /** @var Factory */
    private $factory;

    /** @var Answers $answers */
    private $answers;

    public function __construct(Answers $answers, Factory $factory)
    {
        $this->answers = $answers;
        $this->factory = $factory;
    }

    public function handle(AnswerQuestionCommand $command): void
    {
        $answer = $this->factory->answerQuestion($command->question(), $command->content());

        $this->answers->add($answer);
    }
}
