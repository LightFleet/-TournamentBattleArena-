<?php
namespace Tournament\Entities\Duelists;

class Highlander extends Duelist implements DuelistInterface
{
    protected $hitPoints = 150;
    public $damage;

    public function __construct($type = null)
    {
        $this->equip('greatSword');
        parent::__construct($type);
    }
}
