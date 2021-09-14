<?php
namespace Tournament\Entities\Duelists;

class Viking extends Duelist
{
    protected $hitPoints = 120;
    public $damage;

    public function __construct($type = null)
    {
        $this->equip('axe');
        parent::__construct($type);
    }
}
