<?php
declare(strict_types=1);
namespace Tests\Brainly\Application\Command;

use Brainly\Application\Command\AnswerQuestionCommand;
use Brainly\Domain\Answer;
use Brainly\Domain\Question;
use Mockery;
use PHPUnit\Framework\TestCase;

class AnswerQuestionCommandTest extends TestCase
{
    public function testCommand()
    {
        $question = Mockery::mock(Question::class);
        $answer = Mockery::mock(Answer::class);
        $command = new AnswerQuestionCommand($question, $answer);

        $this->assertSame($question, $command->question());
        $this->assertSame($answer, $command->content());
    }
}
