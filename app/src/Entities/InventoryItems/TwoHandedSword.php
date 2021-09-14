<?php
namespace Tournament\Entities\InventoryItems;

use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\InventoryItems\InventoryItemInterface;

class TwoHandedSword implements InventoryItemInterface
{
    private $owner;

    public function __construct( DuelistInterface $owner )
    {
        $this->owner = $owner;
    }

    public function modifyOwner(  )
    {
        $this->owner->damage = 12;
        $this->owner->hasSword = true;
    }
}

