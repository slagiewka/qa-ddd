<?php
declare(strict_types=1);
namespace Brainly\Application\Question\Factory;

use Brainly\Application\Content\Factory as ContentFactory;
use Brainly\Application\Question\Factory;
use Brainly\Domain\Question;
use Cake\Chronos\Chronos;
use Ramsey\Uuid\Uuid;

class DomainFactory implements Factory
{
    /** @var ContentFactory */
    private $contentFactory;

    public function __construct(ContentFactory $contentFactory)
    {
        $this->contentFactory = $contentFactory;
    }

    public function createQuestion(string $content): Question
    {
        return new Question(
            Uuid::uuid4(),
            $this->contentFactory->createContent($content),
            Chronos::now()->timestamp
        );
    }
}
