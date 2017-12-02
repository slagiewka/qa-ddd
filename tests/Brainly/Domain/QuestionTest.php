<?php
declare(strict_types=1);
namespace Tests\Brainly\Domain;

use Brainly\Domain\Answer;
use Brainly\Domain\Content;
use Brainly\Domain\Exception\AnswerCountExceededException;
use Brainly\Domain\Question;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

class QuestionTest extends TestCase
{
    /** @var Question */
    private $question;
    /** @var UuidInterface|MockInterface */
    private $uuid;
    /** @var Content|MockInterface */
    private $content;
    /** @var int */
    private $timestamp;

    protected function setUp()
    {
        $this->uuid = Mockery::mock(UuidInterface::class);
        $this->content = Mockery::mock(Content::class);
        $this->timestamp = 0;
        $this->question = new Question($this->uuid, $this->content, $this->timestamp);
    }

    public function testUuid()
    {
        $result = $this->question->uuid();

        $this->assertSame($this->uuid, $result);
    }

    public function testContent()
    {
        $result = $this->question->content();

        $this->assertSame($this->content, $result);
    }

    public function testCreatedAt()
    {
        $result = $this->question->createdAt();

        $this->assertEquals($this->timestamp, $result);
    }

    public function testEmptyAnswers()
    {
        $result = $this->question->answers();

        $this->assertEmpty($result);

        /** @var Answer|MockInterface $answer */
        $answer = Mockery::mock(Answer::class);
        $this->question->answerQuestion($answer);

        $result = $this->question->answers();
        $this->assertCount(1, $result);
    }

    public function testAnswerQuestion()
    {
        /** @var Answer|MockInterface $answer */
        $answer = Mockery::mock(Answer::class);
        $this->question->answerQuestion($answer);

        $this->assertContains($answer, $this->question->answers());

        $this->question->answerQuestion($answer);

        /** @var Answer|MockInterface $anotherAnswer */
        $anotherAnswer = Mockery::mock(Answer::class);
        try {
            $this->question->answerQuestion($anotherAnswer);
        } catch (AnswerCountExceededException $e) {
        }
        $this->assertNotContains($anotherAnswer, $this->question->answers());
    }

    public function testExceedAnswerCountException()
    {
        /** @var Answer|MockInterface $answer */
        $answer = Mockery::mock(Answer::class);
        $this->question->answerQuestion($answer);
        $this->question->answerQuestion($answer);

        $this->expectException(AnswerCountExceededException::class);
        /** @var Answer|MockInterface $anotherAnswer */
        $anotherAnswer = Mockery::mock(Answer::class);
        $this->question->answerQuestion($anotherAnswer);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
