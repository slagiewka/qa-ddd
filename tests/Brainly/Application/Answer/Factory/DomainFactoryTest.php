<?php
declare(strict_types=1);
namespace Tests\Brainly\Application\Answer\Factory;

use Brainly\Application\Answer\Factory\DomainFactory;
use Brainly\Application\Content\Factory;
use Brainly\Domain\Content;
use Brainly\Domain\Question;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class DomainFactoryTest extends TestCase
{
    public function testAnswerQuestion()
    {
        /** @var Factory|MockInterface $contentFactory */
        $contentFactory = Mockery::mock(Factory::class);
        /** @var Question|MockInterface $question */
        $question = Mockery::mock(Question::class);
        $question->shouldReceive('answerQuestion')->andReturn();
        $answer = 'My totally appropriate answer.';
        $factory = new DomainFactory($contentFactory);

        $content = Mockery::mock(Content::class);
        $content->shouldReceive('__toString')->andReturn($answer);
        $contentFactory->shouldReceive('createContent')->withArgs([$answer])->andReturn($content);

        $result = $factory->answerQuestion($question, $answer);

        $this->assertSame($question, $result->question());
        $this->assertEquals($answer, (string) $result->content());
    }
}
