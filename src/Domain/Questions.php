<?php
declare(strict_types=1);
namespace Brainly\Domain;

use Ramsey\Uuid\UuidInterface;

interface Questions
{
    public function add(Question $question): void;

    public function remove(Question $question): void;

    /** @return Question[] */
    public function all(): array;

    public function findById(UuidInterface $uuid): ?Question;
}
