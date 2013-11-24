<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComponent;

class GitStagedLeaf extends ExecutorAwareComponent
{
    public function getCommand()
    {
        return 'git diff-index --cached --name-only HEAD';
    }
}