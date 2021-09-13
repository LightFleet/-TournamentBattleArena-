<?php
namespace Tournament\Entities\Duelists;

class Highlander extends Duelist implements DuelistInterface
{
    protected $hitPoints;
    public $damage = 12;

    public function __construct($type = null)
    {
        parent::__construct($type);
    }

    public function equip($inventoryItem) : DuelistInterface
    {
        return $this;
    }
}
