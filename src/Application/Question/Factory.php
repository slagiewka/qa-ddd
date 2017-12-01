<?php
declare(strict_types=1);
namespace Brainly\Application\Question;

use Brainly\Domain\Question;

interface Factory
{
    public function createQuestion(string $content): Question;
}
