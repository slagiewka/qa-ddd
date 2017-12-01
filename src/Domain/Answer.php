<?php
declare(strict_types=1);
namespace Brainly\Domain;

use Ramsey\Uuid\UuidInterface;

class Answer
{
    /** @var UuidInterface */
    private $uuid;
    /** @var Question */
    private $question;
    /** @var Content */
    private $content;
    /** @var int */
    private $createdAt;

    public function __construct(UuidInterface $uuid, Question $question, Content $content, int $createdAt)
    {
        $this->uuid = $uuid;
        $question->answerQuestion($this);
        $this->question = $question;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function question(): Question
    {
        return $this->question;
    }

    public function content(): Content
    {
        return $this->content;
    }

    public function createdAt(): int
    {
        return $this->createdAt;
    }
}
