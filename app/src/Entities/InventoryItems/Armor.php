<?php
namespace Tournament\Entities\InventoryItems;

use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\InventoryItems\InventoryItemInterface;

class Armor implements InventoryItemInterface
{
    private $armorBuffValue = 3;

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
        $this->owner->hasArmor = true;
        $this->owner->buffParameter('armor', $this->armorBuffValue);
        $this->owner->debuffParameter('damage', $this->damageDebuffValue);
    }
}

