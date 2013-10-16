<?php

namespace PlMaikeru\CheckCheckIn\Utils\Composite;

use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor;

abstract class ExecutorAwareComposite {
    protected $executor;
    protected $subcomponents;

    public function __construct(Executor $executor = null)
    {
        $this->executor = $executor;
        $this->subcomponents = array();
    }

    public function getSubcomponents()
    {
        return $this->subcomponents;
    }

    public function getExecutor(Executor $executor = null)
    {
        $result = (null === $executor) ? $this->executor : $executor;
        return $result;
    }
}