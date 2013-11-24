<?php

namespace PlMaikeru\CheckCheckIn\Utils\Composite;

use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor;

class ExecutorAwareComposite implements Processable {
    protected $executor;
    protected $subcomponents;

    public function __construct(Executor $executor = null)
    {
        $this->executor = $executor;
        $this->subcomponents = array();
    }

    public function getComponents()
    {
        return $this->subcomponents;
    }

    public function addComponent(Processable $subcomponent)
    {
        foreach ($this->subcomponents as $existing) {
            if ($existing === $subcomponent) {
                return;
            }
        }
        $this->subcomponents[] = $subcomponent;
    }

    public function getExecutor(Executor $executor = null)
    {
        $result = (null === $executor) ? $this->executor : $executor;
        return $result;
    }

    public function process(Executor $executor = null)
    {
        return $this->collectResultsFromSubcomponents($this->getExecutor($executor));
    }



    protected function collectResultsFromSubcomponents(Executor $executor)
    {
        $result = array();
        foreach ($this->subcomponents as $parser) {
            $result = array_merge($result, $parser->process($executor));
        }
        return $result;
    }



}