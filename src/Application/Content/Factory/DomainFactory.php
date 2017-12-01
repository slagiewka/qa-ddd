<?php
declare(strict_types=1);
namespace Brainly\Application\Content\Factory;

use Brainly\Application\Content\Factory;
use Brainly\Domain\Content;

class DomainFactory implements Factory
{
    public function createContent(string $content): Content
    {
        return new Content($content);
    }
}
