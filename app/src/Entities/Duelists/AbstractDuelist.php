<?php


namespace Tournament\Entities\Duelists;


use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\Duelists\DuelistsTypes\DuelistTypeInterface;
use Tournament\Interactors\DuelInteractor;
use Tournament\Interactors\DuelInteractorInterface;

abstract class AbstractDuelist implements DuelistInterface
{
    /**
     * @var DuelistTypeInterface
     */
    private $type;

    public function __construct($type = null)
    {
        $this->type = $type;
        $this->duel = new DuelInteractor();
    }

    public function getClassName() : string
    {
        $path = explode('\\', get_called_class());
        return array_pop($path);
    }

    public function hitPoints() : int
    {
    }

    public function engage(DuelistInterface $enemy)
    {
    }

    public function equip($inventoryItem) : DuelistInterface
    {

    }

    public function getPunch(DuelistInterface $enemy)
    {

    }

    public function isAlive() : bool
    {
    }
}