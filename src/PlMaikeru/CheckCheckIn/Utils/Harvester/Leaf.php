<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor;

abstract class Leaf implements HarvesterInterface
{
    public function harvest(Executor $executor = null)
    {
        $this->throwExceptionIfNoExecutorPassed($executor);

        return $executor->exec($this->getCommand());
    }

    protected abstract function getCommand();

    private function throwExceptionIfNoExecutorPassed($executor)
    {
        if (null === $executor) {
            throw new \InvalidArgumentException('Executor must be passed');
        }
    }
}