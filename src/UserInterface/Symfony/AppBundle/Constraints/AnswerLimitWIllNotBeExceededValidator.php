<?php
declare(strict_types=1);
namespace Brainly\UserInterface\Symfony\AppBundle\Constraints;

use Brainly\Domain\Question;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AnswerLimitWIllNotBeExceededValidator extends ConstraintValidator
{
    const ANSWERS_THRESHOLD = 1;

    /**
     * @param Question                         $value
     * @param AnswerLimitWIllNotBeExceeded|Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (count($value->answers()) > self::ANSWERS_THRESHOLD) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
