<?php
declare(strict_types=1);
namespace Tests\Brainly\Application\Command;

use Brainly\Application\Command\AnswerQuestionCommand;
use Brainly\Domain\Answer;
use Brainly\Domain\Question;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

class AnswerQuestionCommandTest extends TestCase
{
    public function testCommand()
    {
        $uuid = Mockery::mock(UuidInterface::class);
        $question = Mockery::mock(Question::class);
        $answer = Mockery::mock(Answer::class);
        $command = new AnswerQuestionCommand($uuid, $question, $answer);

        $this->assertSame($uuid, $command->uuid());
        $this->assertSame($question, $command->question());
        $this->assertSame($answer, $command->content());
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
