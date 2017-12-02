<?php
declare(strict_types=1);
namespace Brainly\Domain;

use Ramsey\Uuid\UuidInterface;

interface Answers
{
    public function add(Answer $answer): void;

    public function remove(Answer $answer): void;

    /** @return Answer[] */
    public function all(): array;

    public function findById(UuidInterface $uuid): ?Answer;
}
