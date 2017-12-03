<?php
declare(strict_types=1);
namespace Brainly\UserInterface\Symfony\AppBundle\Controller;

use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;

abstract class AbstractResourceController extends FOSRestController
{
    protected function createContextDependentView($data, string $context)
    {
        return $this->view($data)->setContext((new Context())->setGroups([$context]));
    }
}
