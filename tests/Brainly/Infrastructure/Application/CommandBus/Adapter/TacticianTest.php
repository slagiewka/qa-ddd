<?php
declare(strict_types=1);
namespace Tests\Brainly\Infrastructure\Application\CommandBus\Adapter;

use Brainly\Application\Command\Command;
use Brainly\Infrastructure\Application\CommandBus\Adapter\Tactician;
use League\Tactician\CommandBus;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class TacticianTest extends TestCase
{
    public function testHandle()
    {
        /** @var CommandBus|MockInterface $commandBus */
        $commandBus = Mockery::mock(CommandBus::class);
        /** @var Command|MockInterface $command */
        $command = Mockery::mock(Command::class);

        $commandBus->shouldReceive('handle')->once()->with($command);
        $tactician = new Tactician($commandBus);

        $tactician->handle($command);
        $this->assertTrue(true);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
