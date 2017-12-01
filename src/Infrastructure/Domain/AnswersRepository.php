<?php
declare(strict_types=1);
namespace Brainly\Infrastructure\Domain;

use Brainly\Domain\Answer;
use Brainly\Domain\Answers;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class AnswersRepository implements Answers
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
