<?php
namespace PlMaikeru\CheckCheckIn\Utils\Parser;
use PlMaikeru\CheckCheckIn\Utils\Composite\Processable;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor,
    \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite;

class GenericParser extends ExecutorAwareComposite implements ParserInterface
{
    public function addComponent(Processable $subparser)
    {
        return parent::addComponent($subparser);
    }

}