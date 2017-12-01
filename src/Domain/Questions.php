<?php
declare(strict_types=1);
namespace Brainly\Domain;

interface Questions
{
    public function add(Question $question): void;

    public function remove(Question $question): void;

    /** @return Question[] */
    public function all(): array;
}
