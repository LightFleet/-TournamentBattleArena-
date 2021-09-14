<?php


namespace Tournament\Entities\Duelists;


use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\Duelists\DuelistsTypes\DuelistTypeInterface;
use Tournament\Entities\Duelists\DuelistsTypes\Veteran;
use Tournament\Entities\Duelists\DuelistsTypes\Vicious;
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
     * @var DuelistTypeInterface[]
     */
    private $types;

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

    const AVAILABLE_TYPES = [
        'Veteran' => Veteran::class,
        'Vicious' => Vicious::class
    ];

    public function __construct( $type = null )
    {
        $this->duel = new DuelInteractor();
        $this->addType($type);
    }

    private function addType( $type )
    {
        if ($type){
            $typeClassName = self::AVAILABLE_TYPES[$type];
            $this->types[$type] = new $typeClassName($this);
        }
    }

    public function equip( $inventoryItem )
    {
        $inventoryItemClass = self::AVAILABLE_INVENTORY_ITEMS[$inventoryItem];
        $this->inventoryItems[$inventoryItem] = new $inventoryItemClass($this);

        return $this;
    }
    public function engage(DuelistInterface $enemy)
    {
        $this->duel->startDuel($this, $enemy);
    }


    public function getPunch(DuelistInterface $enemy)
    {
        if($enemy->canAttackThisTurn() && !$this->enemyDamageIsBlocked($enemy)){
            $this->receiveDamage($enemy);
            print_r(PHP_EOL. PHP_EOL. $this->getClassName() . " got $enemy->damage damage and blocked $this->armor! HP left: $this->hitPoints\n");
        }
    }

    public function buffParameter($name, int $value)
    {
        $this->{$name} += $value;
    }

    public function debuffParameter($name, int $value)
    {
        $this->{$name} -= $value;
    }

    public function multiplyParameter($name, int $value)
    {
        $this->{$name} *= $value;
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
            return $this->inventoryItems['greatSword']->canAttackThisTurn();
        }
        return true;
    }

    private function receiveDamage( DuelistInterface $enemy )
    {
        $this->hitPoints -= ($enemy->damage - $this->armor);
        $this->hitPoints = $this->hitPoints > 0 ? $this->hitPoints : 0;

        if (!empty($this->types['Veteran'])){
            var_dump($this->initialHitPoints*0.3);exit;
        }
        if (!empty($this->types['Veteran']) && ($this->hitPoints < ($this->initialHitPoints*0.3)) {
            $this->types['Veteran']->giveOwnerBerkerkBuff();
        }
    }

    private function hasType( string $string )
    {
        return !empty($this->{$hasItem});
    }
}
