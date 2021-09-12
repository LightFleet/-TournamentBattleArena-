<?php


namespace Tournament\Entities;


use Tournament\Entities\DuelistInterface;

abstract class Duelist
{
    public function engage(DuelistInterface $enemy)
    {

    }

    public function equip($inventoryItem) : DuelistInterface
    {

    }

    public function hitPoints()
    {

    }
}