<?php
declare(strict_types=1);
namespace Brainly\Application\Command;

use Ramsey\Uuid\UuidInterface;

class AskQuestionCommand implements Command
{
    /** @var UuidInterface */
    private $uuid;
    /** @var string */
    private $content;

    public function __construct(UuidInterface $uuid, $content)
    {
        $this->content = $content;
        $this->uuid = $uuid;
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function content()
    {
        return $this->content;
    }
}
