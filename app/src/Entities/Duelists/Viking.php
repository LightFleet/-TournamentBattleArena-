<?php
namespace Tournament\Entities\Duelists;

class Viking extends Duelist
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
