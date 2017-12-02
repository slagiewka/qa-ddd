<?php
declare(strict_types=1);
namespace Tests\Brainly\UserInterface\Symfony\AppBundle\ParamConverter;

use Brainly\Domain\Answer;
use Brainly\Domain\Answers;
use Brainly\UserInterface\Symfony\AppBundle\ParamConverter\UuidAnswerParamConverter;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UuidAnswerParamConverterTest extends TestCase
{
    /** @var UuidAnswerParamConverter */
    private $converter;
    /** @var Answers|MockInterface */
    private $answers;
    /** @var ParamConverter|MockInterface */
    private $configuration;

    protected function setUp()
    {
        $this->answers = Mockery::mock(Answers::class);
        $this->configuration = Mockery::mock(ParamConverter::class);
        $this->converter = new UuidAnswerParamConverter($this->answers);
    }

    public function testSuccessfulApply()
    {
        /** @var Request|MockInterface $request */
        $request = Mockery::mock(Request::class);
        $attributes = Mockery::mock(ParameterBag::class);
        $request->attributes = $attributes;

        $name = 'answer';
        $value = '875d457d-7c86-403d-b14a-f232c776d622'; //Random UUID
        $this->configuration->shouldReceive('getName')->once()->andReturn($name);
        $attributes->shouldReceive('has')->once()->with($name)->andReturn(true);
        $attributes->shouldReceive('get')->once()->with($name)->andReturn($value);

        $answer = Mockery::mock(Answer::class);
        $this->answers->shouldReceive('findById')->once()->andReturn($answer);
        $attributes->shouldReceive('set')->once()->with($name, $answer);

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

        $name = 'answer';
        $this->configuration->shouldReceive('getName')->once()->andReturn($name);
        $attributes->shouldReceive('has')->once()->with($name)->andReturn(false);

        $result = $this->converter->apply($request, $this->configuration);

        $this->assertFalse($result);
    }

    public function testApplyWithAnswerNotFound()
    {
        /** @var Request|MockInterface $request */
        $request = Mockery::mock(Request::class);
        $attributes = Mockery::mock(ParameterBag::class);
        $request->attributes = $attributes;

        $name = 'answer';
        $value = '875d457d-7c86-403d-b14a-f232c776d622'; //Random UUID
        $this->configuration->shouldReceive('getName')->once()->andReturn($name);
        $attributes->shouldReceive('has')->once()->with($name)->andReturn(true);
        $attributes->shouldReceive('get')->once()->with($name)->andReturn($value);

        $this->answers->shouldReceive('findById')->once()->andReturnNull();

        $this->expectException(NotFoundHttpException::class);
        $result = $this->converter->apply($request, $this->configuration);

        $this->assertFalse($result);
    }

    public function testSupports()
    {
        $this->configuration->shouldReceive('getClass')->once()->andReturn(Answer::class);
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
