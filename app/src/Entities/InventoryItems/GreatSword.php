<?php
namespace Tournament\Entities\InventoryItems;

use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\InventoryItems\InventoryItemInterface;

class GreatSword implements InventoryItemInterface
{
    private $owner;
    private $attacksCounter = 0;

    public function __construct( DuelistInterface $owner )
    {
        $this->owner = $owner;
        $this->modifyOwner();
    }

    public function modifyOwner()
    {
        $this->owner->damage = 12;
        $this->owner->hasGreatSword = true;
    }

    public function canAttackThisTurn() : bool
    {
        $this->attacksCounter++;

        if($this->attacksCounter == 3){
            $this->attacksCounter = 0;
            return false;
        }

        return true;
    }
}

