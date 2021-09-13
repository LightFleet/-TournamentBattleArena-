<?php
namespace Tournament\Entities\Duelists;

class Viking extends Duelist
{
    protected $hitPoints = 120;
    public $damage = 6;

    public function __construct($type = null)
    {
        parent::__construct($type);
    }

    public function equip($inventoryItem) : DuelistInterface
    {
        return $this;
    }
}
