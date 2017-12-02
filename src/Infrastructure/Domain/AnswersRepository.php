<?php
declare(strict_types=1);
namespace Brainly\Infrastructure\Domain;

use Brainly\Domain\Answer;
use Brainly\Domain\Answers;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

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

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->manager->getRepository(Answer::class)->findAll();
    }

    public function findById(UuidInterface $uuid): ?Answer
    {
        return $this->manager->getRepository(Answer::class)->find($uuid);
    }
}
