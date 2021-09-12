<?php


namespace Tournament\Interactors;


use Tournament\Entities\Duelists\Duelist;
use Tournament\Entities\Duelists\DuelistInterface;

class DuelInteractor implements DuelInteractorInterface
{
    /**
     * @param DuelistInterface $duelist
     * @param DuelistInterface $enemy
     */
    public function fightToTheDeath(DuelistInterface $duelist, DuelistInterface $enemy)
    {
        while ($duelist->isAlive()){
            $duelist->getPunch($enemy);
            var_dump('Hit! HP Left: ' . $duelist->hitPoints());
        }
        var_dump($duelist->getClassName() . ' is Dead!!!' . PHP_EOL . 'Exiting...'); exit;
    }
}