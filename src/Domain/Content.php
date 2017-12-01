<?php
declare(strict_types=1);
namespace Brainly\Domain;

use Brainly\Domain\Exception\InvalidContentLengthException;
use function strlen;

class Content
{
    const MIN_LENGTH = 20;
    const MAX_LENGTH = 5000;

    /** @var string */
    private $content;

    public function __construct(string $content)
    {
        $this->validateContent($content);
        $this->content = $content;
    }

    private function validateContent(string $content): void
    {
        $length = strlen($content);
        if ($length < self::MIN_LENGTH || $length > self::MAX_LENGTH) {
            throw new InvalidContentLengthException();
        }
    }

    public function __toString()
    {
        return $this->content;
    }
}
