<?php
declare(strict_types=1);
namespace Tests\Brainly\Application\Question\Factory;

use Brainly\Application\Content\Factory;
use Brainly\Application\Question\Factory\DomainFactory;
use Brainly\Domain\Content;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class DomainFactoryTest extends TestCase
{
    public function testCreateQuestion()
    {
        /** @var Factory|MockInterface $contentFactory */
        $contentFactory = Mockery::mock(Factory::class);
        $contentString = 'Content content content';
        $content = Mockery::mock(Content::class);
        $content->shouldReceive('__toString')->andReturn($contentString);
        $contentFactory->shouldReceive('createContent')->withArgs([$contentString])->andReturn($content);
        $factory = new DomainFactory($contentFactory);

        $result = $factory->createQuestion($contentString);

        $this->assertEquals($contentString, (string) $result->content());
    }
}
