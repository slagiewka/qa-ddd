<?php
declare(strict_types=1);
namespace Brainly\Application\Answer;

use Brainly\Domain\Answer;
use Brainly\Domain\Question;

interface Factory
{
    public function answerQuestion(Question $question, string $answer): Answer;
}
