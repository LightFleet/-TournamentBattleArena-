<?php


namespace Tournament\Interactors;


use Tournament\Entities\Duelists\Duelist;
use Tournament\Entities\Duelists\DuelistInterface;

class DuelInteractor implements DuelInteractorInterface
{
    public $duelist;

    public $enemy;

    /**
     * @param DuelistInterface $duelist
     * @param DuelistInterface $enemy
     */

    public function startDuel(DuelistInterface $duelist, DuelistInterface $enemy){

        $this->duelist = $duelist;
        $this->enemy = $enemy;

        $this->fightTillTheDeath();
    }

    public function fightTillTheDeath()
    {
        do {
            $this->enemy->getPunch($this->duelist);
            $this->duelist->getPunch($this->enemy);

        } while (!$this->someoneIsDead());
    }

    public function someoneIsDead() : bool
    {
        return (!$this->duelist->isAlive() or !$this->enemy->isAlive());
    }
}