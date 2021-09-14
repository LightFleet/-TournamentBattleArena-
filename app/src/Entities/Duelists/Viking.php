<?php
namespace Tournament\Entities\Duelists;

class Viking extends Duelist
{
    public $initialHitPoints = 120, $hitPoints = 120;
    public $damage;

    public function __construct($type = null)
    {
        $this->equip('axe');
        parent::__construct($type);
    }
}
