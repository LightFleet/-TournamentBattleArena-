<?php
namespace Tournament\Entities\InventoryItems;

use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\InventoryItems\InventoryItemInterface;

class Axe implements InventoryItemInterface
{
    /**
     * @var DuelistInterface
     */
    private $owner;

    public function __construct( DuelistInterface $owner )
    {
        $this->owner = $owner;
        $this->modifyOwner();
    }

    public function modifyOwner(  )
    {
        $this->owner->damage = 6;
        $this->owner->hasAxe = true;
    }
}

