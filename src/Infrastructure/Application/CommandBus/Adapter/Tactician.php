<?php
declare(strict_types=1);
namespace Brainly\Infrastructure\Application\CommandBus\Adapter;

use Brainly\Application\Command\Command;
use Brainly\Application\CommandBus as BaseCommandBus;
use League\Tactician\CommandBus;

class Tactician implements BaseCommandBus
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function handle(Command $command): void
    {
        $this->commandBus->handle($command);
    }
}
