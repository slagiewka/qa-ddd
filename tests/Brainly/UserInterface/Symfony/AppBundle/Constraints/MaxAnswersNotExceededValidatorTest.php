<?php
declare(strict_types=1);
namespace Tests\Brainly\UserInterface\Symfony\AppBundle\Constraints;

use Brainly\Domain\Question;
use Brainly\UserInterface\Symfony\AppBundle\Constraints\MaxAnswersNotExceeded;
use Brainly\UserInterface\Symfony\AppBundle\Constraints\MaxAnswersNotExceededValidator;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class MaxAnswersNotExceededValidatorTest extends TestCase
{
    /** @var MaxAnswersNotExceededValidator */
    private $validator;
    /** @var MaxAnswersNotExceeded|MockInterface */
    private $constraint;
    /** @var ExecutionContextInterface|MockInterface */
    private $context;

    protected function setUp()
    {
        $this->validator = new MaxAnswersNotExceededValidator();
        $this->constraint = Mockery::mock(MaxAnswersNotExceeded::class);
        $this->constraint->message = 'Validation message';
        $this->context = Mockery::mock(ExecutionContextInterface::class);
        $this->validator->initialize($this->context);
    }

    public function testValidateCorrectQuestion()
    {
        /** @var Question|MockInterface $question */
        $question = Mockery::mock(Question::class);
        $answers = ['single answer'];
        $question->shouldReceive('answers')->once()->withNoArgs()->andReturn($answers);
        $this->validator->validate($question, $this->constraint);

        $this->context->shouldNotHaveReceived('buildViolation');

        $this->assertTrue(true);
    }

    public function testValidateIncorrectQuestion()
    {
        /** @var Question|MockInterface $question */
        $question = Mockery::mock(Question::class);
        $answers = ['first answer', 'second answer'];
        $question->shouldReceive('answers')->once()->withNoArgs()->andReturn($answers);
        $violationBuilder = Mockery::mock(ConstraintViolationBuilderInterface::class);
        $violationBuilder->shouldReceive('addViolation')->once();
        $this
            ->context
            ->shouldReceive('buildViolation')
            ->once()
            ->with($this->constraint->message)
            ->andReturn($violationBuilder)
        ;

        $this->validator->validate($question, $this->constraint);

        $this->assertTrue(true);
    }


    protected function tearDown()
    {
        Mockery::close();
    }
}
