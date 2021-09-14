<?php


namespace Tournament\Entities\Duelists\DuelistsTypes;


use Tournament\Entities\Duelists\DuelistInterface;

class Veteran implements DuelistTypeInterface
{
    private $damageBuffCoeff = 1.3;

    /**
     * @var DuelistInterface
     */
    private $owner;

    public function __construct( DuelistInterface $owner )
    {
        $this->owner = $owner;
    }

    public function giveOwnerBerkerkBuff( )
    {
        var_dump($this->owner->initialHitPoints); exit;
        $this->owner->multiplyParameter('damage', 2);
    }
}