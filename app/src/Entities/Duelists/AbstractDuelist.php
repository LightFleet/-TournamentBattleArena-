<?php


namespace Tournament\Entities\Duelists;


use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\Duelists\DuelistsTypes\DuelistTypeInterface;
use Tournament\Entities\InventoryItems\Armor;
use Tournament\Entities\InventoryItems\Axe;
use Tournament\Entities\InventoryItems\Buckler;
use Tournament\Entities\InventoryItems\OneHandedSword;
use Tournament\Entities\InventoryItems\TwoHandedSword;
use Tournament\Interactors\DuelInteractor;
use Tournament\Interactors\DuelInteractorInterface;

abstract class AbstractDuelist implements DuelistInterface
{
    /**
     * @var DuelistTypeInterface
     */
    private $type;

    private $inventoryItems = [];

    const AVAILABLE_INVENTORY_ITEMS = [
        'one-handed-sword' => OneHandedSword::class,
        'two-handed-sword' => TwoHandedSword::class,
        'buckler' => Buckler::class,
        'armor' => Armor::class,
        'axe' => Axe::class
    ];

    public function __construct( $type = null )
    {
        $this->type = $type;
    }

    public function getClassName() : string
    {
        $path = explode( '\\', get_called_class() );
        return array_pop( $path );
    }

    public function engage(DuelistInterface $enemy)
    {
        $duel = new DuelInteractor($this, $enemy);

        $duel->fightTillTheDeath();
    }

    public function getPunch(DuelistInterface $enemy)
    {
        if(!$this->damageIsBlocked($enemy)){
            $this->hitPoints -= $enemy->damage;
            $this->hitPoints = $this->hitPoints > 0 ? $this->hitPoints : 0;
        }
    }

    public function equip( $inventoryItem )
    {
        $inventoryItemClass = self::AVAILABLE_INVENTORY_ITEMS[$inventoryItem];

        $this->inventoryItems[$inventoryItem] = new $inventoryItemClass($this);

        return $this;
    }

    public function damageIsBlocked($enemy) : bool
    {
        if (!$this->inventoryItemEquipped('buckler')){
            return false;
        }

        $buckler = $this->inventoryItems['buckler'];

        if (!$buckler->canBlockHit){
            $buckler->canBlockHit = !$buckler->canBlockHit;
            return false;
        }

        if (!empty($enemy->hasAxe)){
            $buckler->getHit();
        }

        $buckler->canBlockHit = !$buckler->canBlockHit;

        return true;
    }

    private function inventoryItemEquipped( string $itemName )
    {
        $hasItem = "has" . strtoupper($itemName);
        var_dump($hasItem); exit;
        return !empty($this->{$hasItem});
    }
}