<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use PlMaikeru\CheckCheckIn\Utils\Composite\Processable;
use PlMaikeru\CheckCheckIn\Utils\Executor\Executor;
interface HarvesterInterface extends Processable
{
    public function process(Executor $executor = null);
}