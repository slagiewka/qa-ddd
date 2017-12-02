<?php
declare(strict_types=1);
namespace Brainly\Application\Answer;

use Brainly\Domain\Answer;
use Brainly\Domain\Question;
use Ramsey\Uuid\UuidInterface;

interface Factory
{
    public function answerQuestion(UuidInterface $uuid, Question $question, string $answer): Answer;
}
