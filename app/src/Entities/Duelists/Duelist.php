<?php


namespace Tournament\Entities\Duelists;

use Tournament\Entities\Duelists\DuelistsTypes\DuelistTypeInterface;

class Duelist extends AbstractDuelist
{
    /**
     * @var DuelistTypeInterface
     */
    private $type;

    public function __construct($type = null)
    {
        $this->type = $type;
        parent::__construct();
    }

    public function hitPoints() : int
    {
        return $this->hitPoints;
    }

    public function isAlive() : bool
    {
        return $this->hitPoints > 0;
    }
}