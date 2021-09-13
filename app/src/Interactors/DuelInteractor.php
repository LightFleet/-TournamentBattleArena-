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
    public function fightTillTheDeath(DuelistInterface $duelist, DuelistInterface $enemy)
    {
        while ($duelist->isAlive() or !$enemy->isAlive()){
            $enemy->getPunch($duelist);
            $duelist->getPunch($enemy);
        }
    }
}