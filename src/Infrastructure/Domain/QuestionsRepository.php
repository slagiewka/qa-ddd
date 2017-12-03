<?php
declare(strict_types=1);
namespace Brainly\Infrastructure\Domain;

use Brainly\Domain\Question;
use Brainly\Domain\Questions;
use Brainly\Infrastructure\Persistence\Doctrine\Repository\QuestionsRepository as DoctrineQuestionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class QuestionsRepository implements Questions
{
    /** @var DoctrineQuestionsRepository */
    private $repository;

    /** @var EntityManagerInterface */
    private $manager;

    public function __construct(DoctrineQuestionsRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    public function add(Question $question): void
    {
        $this->manager->persist($question);
        $this->manager->flush();
    }

    public function remove(Question $question): void
    {
        $this->manager->remove($question);
        $this->manager->flush();
    }

    /** @return Question[] */
    public function all(): array
    {
        return $this->repository->findAll();
    }

    public function findById(UuidInterface $uuid): ?Question
    {
        return $this->repository->find($uuid);
    }
}
