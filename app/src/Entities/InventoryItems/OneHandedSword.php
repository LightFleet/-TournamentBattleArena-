<?php
namespace Tournament\Entities\InventoryItems;

use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\InventoryItems\InventoryItemInterface;

class OneHandedSword implements InventoryItemInterface
{
    private $owner;

    public function __construct( DuelistInterface $owner )
    {
        $this->owner = $owner;
        $this->owner->damage = 5;
        $this->owner->hasSword = true;
    }
}

