<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor;

class GitStagedLeaf extends Leaf
{
    public function getCommand()
    {
        return 'git diff-index --cached --name-only HEAD';
    }
}