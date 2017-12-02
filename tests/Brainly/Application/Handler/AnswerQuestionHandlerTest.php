<?php
declare(strict_types=1);
namespace Tests\Brainly\Application\Handler;

use Brainly\Application\Answer\Factory;
use Brainly\Application\Command\AnswerQuestionCommand;
use Brainly\Application\Handler\AnswerQuestionHandler;
use Brainly\Domain\Answer;
use Brainly\Domain\Answers;
use Brainly\Domain\Question;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class AnswerQuestionHandlerTest extends TestCase
{
    public function testHandle()
    {
        /** @var Answers|MockInterface $answers */
        $answers = Mockery::mock(Answers::class);
        /** @var Factory|MockInterface $factory */
        $factory = Mockery::mock(Factory::class);
        /** @var Answer|MockInterface $answer */
        $answer = Mockery::mock(Answer::class);

        $question = Mockery::mock(Question::class);
        $content = 'test content';
        /** @var AnswerQuestionCommand|MockInterface $command */
        $command = Mockery::mock(AnswerQuestionCommand::class);
        $command->shouldReceive('question')->andReturn($question);
        $command->shouldReceive('content')->andReturn($content);

        $handler = new AnswerQuestionHandler($answers, $factory);

        $factory->shouldReceive('answerQuestion')->once()->with($question, $content)->andReturn($answer);
        $answers->shouldReceive('add')->once()->with($answer);

        $handler->handle($command);

        // Workaround for no-assertions warnings.
        $this->assertTrue(true);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
