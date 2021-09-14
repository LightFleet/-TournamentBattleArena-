<?php
namespace Tournament\Entities\InventoryItems;

use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\InventoryItems\InventoryItemInterface;

class Axe implements InventoryItemInterface
{
    public function __construct( DuelistInterface $owner )
    {
        $this->owner = $owner;
        $this->owner->damage = 6;
        $this->owner->hasAxe = true;
    }
}

