<?php


namespace Tournament\Entities\Duelists\DuelistsTypes;


use Tournament\Entities\Duelists\DuelistInterface;

class Veteran implements DuelistTypeInterface
{
    private $damageBuffCoeff = 2;
    private $berserkMode = false;

    public function giveOwnerTypeBuff(DuelistInterface $duelist)
    {
        $this->berserkMode = true;
        $duelist->multiplyParameter('damage', $this->damageBuffCoeff);
    }

    public function typeBuffWorks(DuelistInterface $duelist) : bool
    {
        return $this->berserkMode;
    }
}