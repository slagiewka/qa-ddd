<?php
declare(strict_types=1);
namespace Brainly\UserInterface\Symfony\AppBundle\ParamConverter;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractUuidParamConverter implements ParamConverterInterface
{
    protected abstract function findValue(UuidInterface $uuid);

    /**
     * {@inheritdoc}
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $name = $configuration->getName();

        if (!$request->attributes->has($name)) {
            return false;
        }

        $value = $request->attributes->get($name);
        $id = Uuid::fromString($value);
        $convertedValue = $this->findValue($id);

        if (null === $convertedValue) {
            throw new NotFoundHttpException(sprintf('Question of ID %s was not found', $id));
        }

        $request->attributes->set($name, $convertedValue);

        return true;
    }
}
