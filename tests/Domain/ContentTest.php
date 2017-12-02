<?php
declare(strict_types=1);
namespace Tests\Brainly\Domain;

use Brainly\Domain\Content;
use Brainly\Domain\Exception\InvalidContentLengthException;
use PHPUnit\Framework\TestCase;

class ContentTest extends TestCase
{
    /**
     * @dataProvider correctContents
     *
     * @param string $contentString
     */
    public function testContentCreate(string $contentString)
    {
        $content = new Content($contentString);

        $this->assertEquals($contentString, (string) $content);
    }

    /**
     * @dataProvider invalidContents
     *
     * @param string $invalidContent
     */
    public function testInvalidContent(string $invalidContent)
    {
        $this->expectException(InvalidContentLengthException::class);

        new Content($invalidContent);
    }

    public function correctContents(): array
    {
        return [
            ['At least twenty characters'],
        ];
    }

    public function invalidContents(): array
    {
        return [
            'too_short' => ['Too short.'],
            '19_chars' => ['1234567891012131415'],
            'too_long' => [<<<EOT
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and o
EOT
],
        ];
    }
}
