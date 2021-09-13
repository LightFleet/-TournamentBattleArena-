<?php
namespace Tournament\Entities\Duelists;

class Swordsman extends Duelist
{
    protected $hitPoints = 100;
    public $damage = 5;

    public function __construct($type = null)
    {
        parent::__construct($type);
    }

    public function equip($inventoryItem) : DuelistInterface
    {
        return $this;
    }
}

