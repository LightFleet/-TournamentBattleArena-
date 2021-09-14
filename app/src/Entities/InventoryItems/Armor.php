<?php
namespace Tournament\Entities\InventoryItems;

use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\InventoryItems\InventoryItemInterface;

class Armor implements InventoryItemInterface
{
    public function __construct( DuelistInterface $owner )
    {
        $this->owner = $owner;
        $this->owner->hasArmor = true;
    }
}

