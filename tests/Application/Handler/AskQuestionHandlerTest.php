<?php
declare(strict_types=1);
namespace Tests\Brainly\Application\Handler;

use Brainly\Application\Command\AskQuestionCommand;
use Brainly\Application\Handler\AskQuestionHandler;
use Brainly\Application\Question\Factory;
use Brainly\Domain\Question;
use Brainly\Domain\Questions;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class AskQuestionHandlerTest extends TestCase
{
    public function testHandle()
    {
        /** @var Questions|MockInterface $questions */
        $questions = Mockery::mock(Questions::class);
        /** @var Factory|MockInterface $factory */
        $factory = Mockery::mock(Factory::class);
        ///** @var Answer|MockInterface $answer */
        //$answer = Mockery::mock(Answer::class);
        //
        $question = Mockery::mock(Question::class);
        $content = 'test content';
        /** @var AskQuestionCommand|MockInterface $command */
        $command = Mockery::mock(AskQuestionCommand::class);
        $command->shouldReceive('content')->andReturn($content);

        $handler = new AskQuestionHandler($questions, $factory);

        $factory->shouldReceive('createQuestion')->once()->with($content)->andReturn($question);
        $questions->shouldReceive('add')->once()->with($question);

        $handler->handle($command);

        // Workaround for no-assertions warnings.
        $this->assertTrue(true);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
