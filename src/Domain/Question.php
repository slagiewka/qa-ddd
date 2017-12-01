<?php
declare(strict_types=1);
namespace Brainly\Domain;

use Brainly\Domain\Exception\AnswerCountExceededException;
use Ramsey\Uuid\UuidInterface;

class Question
{
    /** @var UuidInterface */
    private $uuid;
    /** @var Content */
    private $content;
    /** @var int */
    private $createdAt;
    /** @var Answer[] */
    private $answers;

    public function __construct(UuidInterface $uuid, Content $content, int $createdAt)
    {
        $this->uuid = $uuid;
        $this->answers = [];
        $this->content = $content;
        $this->createdAt = $createdAt;
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function content(): Content
    {
        return $this->content;
    }

    public function createdAt(): int
    {
        return $this->createdAt;
    }

    public function answers()
    {
        return $this->answers;
    }

    public function answerQuestion(Answer $answer): void
    {
        if (count($this->answers) >= 2) {
            throw new AnswerCountExceededException();
        }

        $this->answers[] = $answer;
    }
}
