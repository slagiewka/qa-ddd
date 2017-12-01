<?php
declare(strict_types=1);
namespace Brainly\UserInterface\Symfony\AppBundle\Constraints;

use Brainly\Domain\Question;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MaxAnswersNotExceededValidator extends ConstraintValidator
{
    /**
     * @param Question                         $value
     * @param MaxAnswersNotExceeded|Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (count($value->answers()) > 1) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
