<?php
declare(strict_types=1);
namespace Brainly\Application\Command;

class AskQuestionCommand implements Command
{
    /** @var string */
    private $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function content()
    {
        return $this->content;
    }
}
