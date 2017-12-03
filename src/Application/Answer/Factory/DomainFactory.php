<?php
declare(strict_types=1);
namespace Brainly\Application\Answer\Factory;

use Brainly\Application\Answer\Factory;
use Brainly\Application\Content\Factory as ContentFactory;
use Brainly\Domain\Answer;
use Brainly\Domain\Question;
use Cake\Chronos\Chronos;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class DomainFactory implements Factory
{
    /** @var ContentFactory */
    private $contentFactory;

    public function __construct(ContentFactory $contentFactory)
    {
        $this->contentFactory = $contentFactory;
    }

    public function createAnswer(UuidInterface $uuid, Question $question, string $answer): Answer
    {
        return new Answer(
            $uuid,
            $question,
            $this->contentFactory->createContent($answer),
            Chronos::now()->timestamp
        );
    }
}
