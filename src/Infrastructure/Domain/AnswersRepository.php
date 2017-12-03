<?php
declare(strict_types=1);
namespace Brainly\Infrastructure\Domain;

use Brainly\Domain\Answer;
use Brainly\Domain\Answers;
use Brainly\Infrastructure\Persistence\Doctrine\Repository\AnswersRepository as DoctrineAnswersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class AnswersRepository implements Answers
{
    /** @var DoctrineAnswersRepository */
    private $repository;
    /** @var EntityManagerInterface */
    private $manager;

    public function __construct(DoctrineAnswersRepository $repository, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        $this->repository = $repository;
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
        return $this->repository->findAll();
    }

    public function findById(UuidInterface $uuid): ?Answer
    {
        return $this->repository->find($uuid);
    }
}
