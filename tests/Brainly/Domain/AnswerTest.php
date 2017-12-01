<?php
declare(strict_types=1);
namespace Tests\Brainly\Domain;

use Brainly\Domain\Answer;
use Brainly\Domain\Content;
use Brainly\Domain\Question;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

class AnswerTest extends TestCase
{
    /** @var Answer */
    private $answer;
    /** @var Question|MockInterface */
    private $question;
    /** @var Content|MockInterface */
    private $content;
    /** @var int */
    private $timestamp;
    /** @var UuidInterface|MockInterface */
    private $uuid;

    protected function setUp()
    {
        $this->question = Mockery::mock(Question::class);
        $this->question->shouldReceive('answerQuestion')->once()->andReturn();
        $this->content = Mockery::mock(Content::class);
        $this->uuid = Mockery::mock(UuidInterface::class);
        $this->timestamp = 0;

        $this->answer = new Answer($this->uuid, $this->question, $this->content, $this->timestamp);
    }

    public function testUuid()
    {
        $result = $this->answer->uuid();

        $this->assertSame($this->uuid, $result);
    }

    public function testQuestion()
    {
        $result = $this->answer->question();

        $this->assertSame($this->question, $result);
    }

    public function testContent()
    {
        $result = $this->answer->content();

        $this->assertSame($this->content, $result);
    }

    public function testCreatedAt()
    {
        $result = $this->answer->createdAt();

        $this->assertSame($this->timestamp, $result);
    }
}
