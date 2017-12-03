<?php
declare(strict_types=1);
namespace Brainly\Infrastructure\Persistence\Doctrine\Repository;

use Brainly\Domain\Question;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class QuestionsRepository extends EntityRepository
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em, new ClassMetadata(Question::class));
    }
}
