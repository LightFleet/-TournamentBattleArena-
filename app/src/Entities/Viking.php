<?php
namespace Tournament\Entities;

class Viking extends Duelist implements DuelistInterface
{
    public function __construct($role = null)
    {

    }

    public function engage(DuelistInterface $enemy)
    {

    }

    public function equip($inventoryItem) : DuelistInterface
    {
        return $this;
    }

    public function hitPoints()
    {

    }
}
