<?php
declare(strict_types=1);
namespace Brainly\Infrastructure\Domain;

use Brainly\Domain\Answer;
use Brainly\Domain\Answers;
use Doctrine\ORM\EntityManagerInterface;

class AnswersRepository implements Answers
{
    /** @var EntityManagerInterface */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function add(Answer $answer): void
    {
        $this->manager->persist($answer);
        $this->manager->flush();
    }

    public function remove(Answer $answer): void
    {
        $this->manager->remove($answer);
        $this->manager->flush();
    }
}
