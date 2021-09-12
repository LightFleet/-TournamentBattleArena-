<?php
namespace Tournament\Entities\Duelists;

class Highlander extends Duelist implements DuelistInterface
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
