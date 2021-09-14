<?php


namespace Tournament\Entities\Duelists;


use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\Duelists\DuelistsTypes\DuelistTypeInterface;
use Tournament\Entities\InventoryItems\Armor;
use Tournament\Entities\InventoryItems\Axe;
use Tournament\Entities\InventoryItems\Buckler;
use Tournament\Entities\InventoryItems\OneHandedSword;
use Tournament\Interactors\DuelInteractor;
use Tournament\Interactors\DuelInteractorInterface;

abstract class AbstractDuelist implements DuelistInterface
{
    /**
     * @var DuelistTypeInterface
     */
    private $type;

    private $inventoryItems = [];

    const AVAILABLE_INVENTORY_ITEMS = [ 'one-handed-sword' => OneHandedSword::class, 'buckler' => Buckler::class, 'armor' => Armor::class, 'axe' => Axe::class ];

    public function __construct( $type = null )
    {
        $this->type = $type;
        $this->duel = new DuelInteractor();
    }

    public function getClassName() : string
    {
        $path = explode( '\\', get_called_class() );
        return array_pop( $path );
    }

    public function equip( $inventoryItem )
    {
        $inventoryItemClass = self::AVAILABLE_INVENTORY_ITEMS[$inventoryItem];

        $this->inventoryItems[] = new $inventoryItemClass($this);

        return $this;
    }
}