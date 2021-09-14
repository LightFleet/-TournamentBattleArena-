<?php
namespace Tournament\Entities\Duelists;

class Highlander extends Duelist implements DuelistInterface
{
    public $initialHitPoints = 150, $hitPoints = 150;
    public $damage;

    public function __construct($type = null)
    {
        $this->equip('greatSword');
        parent::__construct($type);
    }
}
