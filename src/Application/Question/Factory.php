<?php
declare(strict_types=1);
namespace Brainly\Application\Question;

use Brainly\Domain\Question;
use Ramsey\Uuid\UuidInterface;

interface Factory
{
    public function createQuestion(UuidInterface $uuid, string $content): Question;
}
