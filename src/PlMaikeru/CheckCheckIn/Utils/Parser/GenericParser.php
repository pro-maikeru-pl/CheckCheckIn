<?php
namespace PlMaikeru\CheckCheckIn\Utils\Parser;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor,
    \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite;

class GenericParser extends ExecutorAwareComposite implements ParserInterface
{
    public function addSubparser(ParserInterface $subparser)
    {
        foreach ($this->subcomponents as $existing) {
            if ($existing === $subparser) {
                return;
            }
        }
        $this->subcomponents[] = $subparser;
    }
}