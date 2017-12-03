<?php
declare(strict_types=1);
namespace Brainly\Infrastructure\Persistence\Doctrine\Repository;

use Brainly\Domain\Answer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class AnswersRepository extends EntityRepository
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em, new ClassMetadata(Answer::class));
    }
}
