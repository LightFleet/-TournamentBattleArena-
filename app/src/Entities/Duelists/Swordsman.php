<?php
namespace Tournament\Entities\Duelists;

class Swordsman extends Duelist
{
    private $hitPoints;

    public function __construct($type = null)
    {

    }

    public function engage(DuelistInterface $enemy)
    {

    }

    public function equip($inventoryItem) : DuelistInterface
    {
        return $this;
    }
}

