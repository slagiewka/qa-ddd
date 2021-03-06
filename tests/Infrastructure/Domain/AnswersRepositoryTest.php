<?php
declare(strict_types=1);
namespace Tests\Brainly\Infrastructure\Domain;

use Brainly\Domain\Answer;
use Brainly\Infrastructure\Domain\AnswersRepository;
use Brainly\Infrastructure\Persistence\Doctrine\Repository\AnswersRepository as DoctrineAnswersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

class AnswersRepositoryTest extends TestCase
{
    /** @var AnswersRepository */
    private $repository;
    /** @var EntityManagerInterface|MockInterface */
    private $entityManager;
    /** @var DoctrineAnswersRepository|MockInterface */
    private $doctrineRepository;
    /** @var Answer|MockInterface */
    private $answer;

    protected function setUp()
    {
        $this->entityManager = Mockery::mock(EntityManagerInterface::class);
        $this->doctrineRepository = Mockery::mock(DoctrineAnswersRepository::class);
        $this->answer = Mockery::mock(Answer::class);
        $this->repository = new AnswersRepository($this->doctrineRepository, $this->entityManager);
    }

    public function testAdd()
    {
        $this->entityManager->shouldReceive('persist')->once()->with($this->answer);
        $this->entityManager->shouldReceive('flush')->once()->withNoArgs();
        $this->repository->add($this->answer);

        $this->assertTrue(true);
    }

    public function testRemove()
    {
        $this->entityManager->shouldReceive('remove')->once()->with($this->answer);
        $this->entityManager->shouldReceive('flush')->once()->withNoArgs();
        $this->repository->remove($this->answer);

        $this->assertTrue(true);
    }

    public function testAll()
    {
        $answers = ['answer', 'answer'];
        $this
            ->doctrineRepository
            ->shouldReceive('findAll')
            ->once()
            ->andReturn($answers)
        ;

        $result = $this->repository->all();

        $this->assertEquals($answers, $result);
    }

    public function testFindById()
    {
        /** @var UuidInterface|MockInterface $uuid */
        $uuid = Mockery::mock(UuidInterface::class);

        $this->doctrineRepository->shouldReceive('find')->once()->with($uuid)->andReturnNull();
        $result = $this->repository->findById($uuid);
        $this->assertNull($result);

        $this->doctrineRepository->shouldReceive('find')->once()->with($uuid)->andReturn($this->answer);
        $result = $this->repository->findById($uuid);
        $this->assertEquals($this->answer, $result);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
