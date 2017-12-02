<?php
declare(strict_types=1);
namespace Tests\Brainly\UserInterface\Symfony\AppBundle\ParamConverter;

use Brainly\Domain\Question;
use Brainly\Domain\Questions;
use Brainly\UserInterface\Symfony\AppBundle\ParamConverter\UuidQuestionParamConverter;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UuidQuestionParamConverterTest extends TestCase
{
    /** @var UuidQuestionParamConverter */
    private $converter;
    /** @var Questions|MockInterface */
    private $questions;
    /** @var ParamConverter|MockInterface */
    private $configuration;

    protected function setUp()
    {
        $this->questions = Mockery::mock(Questions::class);
        $this->configuration = Mockery::mock(ParamConverter::class);
        $this->converter = new UuidQuestionParamConverter($this->questions);
    }

    public function testSuccessfulApply()
    {
        /** @var Request|MockInterface $request */
        $request = Mockery::mock(Request::class);
        $attributes = Mockery::mock(ParameterBag::class);
        $request->attributes = $attributes;

        $name = 'question';
        $value = '875d457d-7c86-403d-b14a-f232c776d622'; //Random UUID
        $this->configuration->shouldReceive('getName')->once()->andReturn($name);
        $attributes->shouldReceive('has')->once()->with($name)->andReturn(true);
        $attributes->shouldReceive('get')->once()->with($name)->andReturn($value);

        $question = Mockery::mock(Question::class);
        $this->questions->shouldReceive('findById')->once()->andReturn($question);
        $attributes->shouldReceive('set')->once()->with($name, $question);

        $result = $this->converter->apply($request, $this->configuration);

        $this->assertTrue($result);
    }

    public function testApplyWithEmptyAttributes()
    {
        /** @var Request|MockInterface $request */
        $request = Mockery::mock(Request::class);
        $attributes = Mockery::mock(ParameterBag::class);
        $request->attributes = $attributes;
        /** @var ParamConverter|MockInterface $configuration */

        $name = 'question';
        $this->configuration->shouldReceive('getName')->once()->andReturn($name);
        $attributes->shouldReceive('has')->once()->with($name)->andReturn(false);

        $result = $this->converter->apply($request, $this->configuration);

        $this->assertFalse($result);
    }

    public function testApplyWithQuestionNotFound()
    {
        /** @var Request|MockInterface $request */
        $request = Mockery::mock(Request::class);
        $attributes = Mockery::mock(ParameterBag::class);
        $request->attributes = $attributes;

        $name = 'question';
        $value = '875d457d-7c86-403d-b14a-f232c776d622'; //Random UUID
        $this->configuration->shouldReceive('getName')->once()->andReturn($name);
        $attributes->shouldReceive('has')->once()->with($name)->andReturn(true);
        $attributes->shouldReceive('get')->once()->with($name)->andReturn($value);

        $this->questions->shouldReceive('findById')->once()->andReturnNull();

        $this->expectException(NotFoundHttpException::class);
        $result = $this->converter->apply($request, $this->configuration);

        $this->assertFalse($result);
    }

    public function testSupports()
    {
        $this->configuration->shouldReceive('getClass')->once()->andReturn(Question::class);
        $result = $this->converter->supports($this->configuration);
        $this->assertTrue($result);

        $this->configuration->shouldReceive('getClass')->once()->andReturn('somethingElse');
        $result = $this->converter->supports($this->configuration);
        $this->assertFalse($result);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
