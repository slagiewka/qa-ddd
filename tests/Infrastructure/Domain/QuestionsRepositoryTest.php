<?php
declare(strict_types=1);
namespace Tests\Brainly\Infrastructure\Domain;

use Brainly\Domain\Question;
use Brainly\Infrastructure\Domain\QuestionsRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

class QuestionsRepositoryTest extends TestCase
{
    /** @var QuestionsRepository */
    private $repository;
    /** @var EntityManagerInterface|MockInterface */
    private $entityManager;
    /** @var Question|MockInterface */
    private $question;
    /** @var ObjectRepository|MockInterface */
    private $objectRepository;

    protected function setUp()
    {
        $this->entityManager = Mockery::mock(EntityManagerInterface::class);
        $this->objectRepository = Mockery::mock(ObjectRepository::class);
        $this->question = Mockery::mock(Question::class);
        $this->repository = new QuestionsRepository($this->objectRepository, $this->entityManager);
    }

    public function testAdd()
    {
        $this->entityManager->shouldReceive('persist')->once()->with($this->question);
        $this->entityManager->shouldReceive('flush')->once()->withNoArgs();
        $this->repository->add($this->question);

        $this->assertTrue(true);
    }

    public function testRemove()
    {
        $this->entityManager->shouldReceive('remove')->once()->with($this->question);
        $this->entityManager->shouldReceive('flush')->once()->withNoArgs();
        $this->repository->remove($this->question);

        $this->assertTrue(true);
    }

    public function testAll()
    {
        $questionsArray = [
            'mock1',
            'mock2',
            'mock3',
        ];
        $this
            ->objectRepository
            ->shouldReceive('findAll')
            ->once()
            ->withNoArgs()
            ->andReturn($questionsArray)
        ;
        $result = $this->repository->all();

        $this->assertCount(count($questionsArray), $result);
    }

    public function testFindById()
    {
        /** @var UuidInterface|MockInterface $uuid */
        $uuid = Mockery::mock(UuidInterface::class);

        $this->objectRepository->shouldReceive('find')->once()->with($uuid)->andReturnNull();
        $result = $this->repository->findById($uuid);
        $this->assertEquals(null, $result);

        $this->objectRepository->shouldReceive('find')->once()->with($uuid)->andReturn($this->question);
        $result = $this->repository->findById($uuid);
        $this->assertEquals($this->question, $result);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
