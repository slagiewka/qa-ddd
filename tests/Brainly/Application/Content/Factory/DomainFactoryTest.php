<?php
declare(strict_types=1);
namespace Tests\Brainly\Application\Content\Factory;

use Brainly\Application\Content\Factory\DomainFactory;
use PHPUnit\Framework\TestCase;

class DomainFactoryTest extends TestCase
{
    public function testCreateContent()
    {
        $factory = new DomainFactory();
        $content = 'Content content content';

        $result = $factory->createContent($content);

        $this->assertEquals($content, (string) $result);
    }
}
