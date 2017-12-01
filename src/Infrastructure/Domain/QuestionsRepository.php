<?php
declare(strict_types=1);
namespace Brainly\Infrastructure\Domain;

use Brainly\Domain\Question;
use Brainly\Domain\Questions;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class QuestionsRepository implements Questions
{
    /** @var ObjectRepository */
    private $repository;

    /** @var EntityManagerInterface */
    private $manager;

    public function __construct(ObjectRepository $repository, EntityManagerInterface $manager)
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
}
