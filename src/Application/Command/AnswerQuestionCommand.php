<?php
declare(strict_types=1);
namespace Brainly\Application\Command;

use Brainly\Domain\Question;
use Ramsey\Uuid\UuidInterface;

class AnswerQuestionCommand implements Command
{
    /** @var UuidInterface */
    private $uuid;
    /** @var Question */
    private $question;
    /** @var string */
    private $content;

    public function __construct(UuidInterface $uuid, $question, $answer)
    {
        $this->uuid = $uuid;
        $this->question = $question;
        $this->content = $answer;
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function question()
    {
        return $this->question;
    }

    public function content()
    {
        return $this->content;
    }
}
