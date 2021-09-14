<?php


namespace Tournament\Entities\Duelists\DuelistsTypes;


use Tournament\Entities\Duelists\DuelistInterface;

class Vicious implements DuelistTypeInterface
{
    public $poisonDamageBuff = 20;
    private $poisonLeftForAttacks = 2;

    public function giveOwnerTypeBuff(DuelistInterface $duelist)
    {
        $duelist->buffParameter('damageFromBuffs', $this->poisonDamageBuff);
    }

    public function typeBuffWorks(DuelistInterface $duelist = null) : bool
    {
        return $this->poisonLeftForAttacks > 0;
    }

    public function reducePosionByOne()
    {
        return $this->poisonLeftForAttacks--;
    }
}