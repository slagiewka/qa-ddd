<?php
declare(strict_types=1);
namespace Brainly\UserInterface\Symfony\AppBundle\Constraints;

use Symfony\Component\Validator\Constraint;

class MaxAnswersNotExceeded extends Constraint
{
    public $message;
}
