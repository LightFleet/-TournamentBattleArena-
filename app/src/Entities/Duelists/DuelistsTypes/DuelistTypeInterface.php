<?php


namespace Tournament\Entities\Duelists\DuelistsTypes;


use Tournament\Entities\Duelists\DuelistInterface;

interface DuelistTypeInterface
{
    public function giveOwnerTypeBuff(DuelistInterface $duelist);
    public function typeBuffWorks(DuelistInterface $duelist) : bool;
}