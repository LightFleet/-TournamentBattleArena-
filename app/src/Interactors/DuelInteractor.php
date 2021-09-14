<?php


namespace Tournament\Interactors;


use Tournament\Entities\Duelists\Duelist;
use Tournament\Entities\Duelists\DuelistInterface;

class DuelInteractor implements DuelInteractorInterface
{
    public $round = 0;

    public $duelist;

    public $enemy;

    /**
     * @param DuelistInterface $duelist
     * @param DuelistInterface $enemy
     */

    public function __construct(DuelistInterface $duelist, DuelistInterface $enemy)
    {
        $this->duelist = $duelist;
        $this->enemy = $enemy;
    }

    public function fightTillTheDeath()
    {
        while (true){

            $this->enemy->getPunch($this->duelist);
            $this->duelist->getPunch($this->enemy);

            if ($this->someoneIsDead()){
                break;
            }

            $this->round++;
        }
    }

    public function someoneIsDead() : bool
    {
        return (!$this->duelist->isAlive() or !$this->enemy->isAlive());
    }
}