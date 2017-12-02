<?php
declare(strict_types=1);
namespace Brainly\Application\Handler;

use Brainly\Application\Command\AskQuestionCommand;
use Brainly\Application\Question\Factory;
use Brainly\Domain\Questions;

class AskQuestionHandler
{
    /** @var Questions */
    private $questions;

    /** @var Factory */
    private $factory;

    public function __construct(Questions $questions, Factory $factory)
    {
        $this->questions = $questions;
        $this->factory = $factory;
    }

    public function handle(AskQuestionCommand $command): void
    {
        $question = $this->factory->createQuestion($command->uuid(), $command->content());
        $this->questions->add($question);
    }
}
