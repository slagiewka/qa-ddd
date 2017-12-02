<?php
declare(strict_types=1);
namespace Brainly\Application\Command;

use Ramsey\Uuid\UuidInterface;

interface Command
{
    public function uuid(): UuidInterface;
}
