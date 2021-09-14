<?php
namespace Tournament\Entities\Duelists;

class Swordsman extends Duelist
{
    protected $hitPoints = 100;
    public $damage;

    public function __construct($type = null)
    {
        $this->equip('one-handed-sword');
        parent::__construct($type);
    }
}

