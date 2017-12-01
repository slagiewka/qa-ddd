<?php
declare(strict_types=1);
namespace Brainly\Application\Content;

use Brainly\Domain\Content;

interface Factory
{
    public function createContent(string $content): Content;
}
