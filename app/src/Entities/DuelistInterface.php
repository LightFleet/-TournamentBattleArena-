<?php


namespace Tournament\Entities;


interface DuelistInterface
{
    public function __construct($role);
    public function engage(DuelistInterface $enemy);
    public function equip($inventoryItem) : DuelistInterface;
    public function hitPoints();
}