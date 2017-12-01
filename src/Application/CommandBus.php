<?php
declare(strict_types=1);
namespace Brainly\Application;

use Brainly\Application\Command\Command;

interface CommandBus
{
    public function handle(Command $command): void;
}
