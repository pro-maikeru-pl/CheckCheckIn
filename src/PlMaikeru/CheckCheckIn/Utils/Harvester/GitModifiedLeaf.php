<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComponent;

class GitModifiedLeaf extends ExecutorAwareComponent
{
    public function getCommand()
    {
        return 'git ls-files --modified';
    }
}