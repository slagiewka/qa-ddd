<?php
declare(strict_types=1);
namespace Tests\Brainly\Application\Command;

use Brainly\Application\Command\AskQuestionCommand;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

class AskQuestionCommandTest extends TestCase
{
    public function testCommand()
    {
        $uuid = Mockery::mock(UuidInterface::class);
        $question = 'Test question';
        $command = new AskQuestionCommand($uuid, $question);

        $this->assertSame($uuid, $command->uuid());
        $this->assertSame($question, $command->content());
    }
}
