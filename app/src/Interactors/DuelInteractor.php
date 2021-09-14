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
        while (true){
            $enemy->getPunch($duelist);
            $duelist->getPunch($enemy);
            if (!$duelist->isAlive() or !$enemy->isAlive()){
                break;
            }
        }
    }
}