<?php
declare(strict_types=1);
namespace Brainly\Domain;

interface Answers
{
    public function add(Answer $answer): void;

    public function remove(Answer $answer): void;
}
