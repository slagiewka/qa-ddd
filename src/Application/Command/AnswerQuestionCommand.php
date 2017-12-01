<?php
declare(strict_types=1);
namespace Brainly\Application\Command;

use Brainly\Domain\Question;

class AnswerQuestionCommand implements Command
{
    /** @var Question */
    private $question;

    /** @var string */
    private $content;

    public function __construct($question, $answer)
    {
        $this->question = $question;
        $this->content = $answer;
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
