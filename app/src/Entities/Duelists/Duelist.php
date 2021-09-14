<?php


namespace Tournament\Entities\Duelists;

use Tournament\Entities\Duelists\DuelistsTypes\DuelistTypeInterface;

class Duelist extends AbstractDuelist
{
    public function hitPoints() : int
    {
        return $this->hitPoints;
    }

    public function isAlive() : bool
    {
        return $this->hitPoints > 0;
    }
}