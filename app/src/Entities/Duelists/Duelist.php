<?php


namespace Tournament\Entities\Duelists;


use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\Duelists\DuelistsTypes\DuelistTypeInterface;
use Tournament\Interactors\DuelInteractor;
use Tournament\Interactors\DuelInteractorInterface;

class Duelist extends AbstractDuelist
{
    /**
     * @var DuelistTypeInterface
     */
    private $type;

    /**
     * @var DuelInteractor
     */
    public $duel;

    public function __construct($type = null)
    {
        $this->type = $type;
        parent::__construct();
    }

    public function hitPoints() : int
    {
        return $this->hitPoints;
    }

    public function engage(DuelistInterface $enemy)
    {
        $this->duel->fightTillTheDeath($this, $enemy);
    }

    public function equip($inventoryItem) : DuelistInterface
    {

    }

    public function getPunch(DuelistInterface $enemy)
    {
        $this->hitPoints -= $enemy->damage;
        $this->hitPoints = $this->isAlive() ? $this->hitPoints : 0;

        print_r($this->getClassName() . ' gets '. $enemy->damage . ' damage by a ' . $enemy->getClassName() .'! HP Left: ' . $this->hitPoints() . PHP_EOL);

    }

    public function isAlive() : bool
    {
        return $this->hitPoints > 0;
    }
}