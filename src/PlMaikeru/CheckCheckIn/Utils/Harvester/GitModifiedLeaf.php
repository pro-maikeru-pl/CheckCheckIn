<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor;

class GitModifiedLeaf extends Leaf
{
    public function getCommand()
    {
        return 'git ls-files --modified';
    }
}