<?php
declare(strict_types=1);
namespace Tests\Brainly\Application\Command;

use Brainly\Application\Command\AskQuestionCommand;
use Mockery;
use PHPUnit\Framework\TestCase;

class AskQuestionCommandTest extends TestCase
{
    public function testCommand()
    {
        $question = 'Test question';
        $command = new AskQuestionCommand($question);

        $this->assertSame($question, $command->content());
    }
}
