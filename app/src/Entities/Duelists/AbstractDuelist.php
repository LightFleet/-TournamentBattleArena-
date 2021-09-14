<?php


namespace Tournament\Entities\Duelists;


use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\Duelists\DuelistsTypes\DuelistTypeInterface;
use Tournament\Entities\InventoryItems\Armor;
use Tournament\Entities\InventoryItems\Axe;
use Tournament\Entities\InventoryItems\Buckler;
use Tournament\Entities\InventoryItems\OneHandedSword;
use Tournament\Entities\InventoryItems\GreatSword;
use Tournament\Interactors\DuelInteractor;
use Tournament\Interactors\DuelInteractorInterface;

abstract class AbstractDuelist implements DuelistInterface
{
    /**
     * @var DuelistTypeInterface
     */
    private $type;

    /**
     * @var DuelInteractor
     */
    public $duel;

    private $inventoryItems = [];

    private $armor = 0;

    const AVAILABLE_INVENTORY_ITEMS = [
        'one-handed-sword' => OneHandedSword::class,
        'greatSword' => GreatSword::class,
        'buckler' => Buckler::class,
        'armor' => Armor::class,
        'axe' => Axe::class
    ];

    public function __construct( $type = null )
    {
        $this->duel = new DuelInteractor();

        $this->type = $type;
    }

    public function buffParameter($name, int $value)
    {
        $this->{$name} += $value;
    }

    public function debuffParameter($name, int $value)
    {
        $this->{$name} -= $value;
    }

    public function getClassName() : string
    {
        $path = explode( '\\', get_called_class() );
        return array_pop( $path );
    }

    private function inventoryItemEquipped( string $itemName )
    {
        $hasItem = "has" . ucwords($itemName);

        return !empty($this->{$hasItem});
    }

    public function engage(DuelistInterface $enemy)
    {
        $this->duel->startDuel($this, $enemy);
    }

    public function getPunch(DuelistInterface $enemy)
    {
        if($enemy->canAttackThisTurn() && !$this->enemyDamageIsBlocked($enemy)){
            $this->receiveDamage($enemy);
        }
    }

    public function equip( $inventoryItem )
    {
        $inventoryItemClass = self::AVAILABLE_INVENTORY_ITEMS[$inventoryItem];

        $this->inventoryItems[$inventoryItem] = new $inventoryItemClass($this);

        return $this;
    }

    public function enemyDamageIsBlocked($enemy) : bool
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

    public function canAttackThisTurn() : bool
    {
        if ($this->inventoryItemEquipped('greatSword')){
            $greatSword = $this->inventoryItems['greatSword'];
            return $greatSword->canAttackThisTurn();
        }
        return true;
    }

    private function receiveDamage( DuelistInterface $enemy )
    {
        $this->hitPoints -= ($enemy->damage - $this->armor);
        $this->hitPoints = $this->hitPoints > 0 ? $this->hitPoints : 0;
    }
}
