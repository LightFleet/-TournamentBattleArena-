<?php
namespace Tournament\Entities\Duelists;

class Swordsman extends Duelist
{
    public $initialHitPoints = 100, $hitPoints = 100;
    public $damage;

    public function __construct($type = null)
    {
        $this->equip('one-handed-sword');
        parent::__construct($type);
    }
}
