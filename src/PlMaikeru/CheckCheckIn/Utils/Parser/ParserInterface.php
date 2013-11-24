<?php
namespace PlMaikeru\CheckCheckIn\Utils\Parser;
use PlMaikeru\CheckCheckIn\Utils\Composite\Processable;
use PlMaikeru\CheckCheckIn\Utils\Executor\Executor;

interface ParserInterface extends Processable
{
    public function process(Executor $executor = null);
}