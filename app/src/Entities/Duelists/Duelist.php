<?php


namespace Tournament\Entities\Duelists;


use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Interactors\DuelInteractor;
use Tournament\Interactors\DuelInteractorInterface;

abstract class Duelist implements DuelistInterface
{
    private $hitPoints, $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function engage(DuelistInterface $enemy)
    {
        $duel = new DuelInteractor();
    }

    public function equip($inventoryItem) : DuelistInterface
    {

    }

    public function hitPoints() : int
    {
        return $this->hitPoints;
    }
}