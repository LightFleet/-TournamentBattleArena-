<?php


namespace Tournament\Entities\Duelists;


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
     * @var DuelistTypeInterface
     */
    private $type;

    /**
     * @var DuelInteractor
     */
    public $duel;

    private $inventoryItems = [];

    private $armor = 0;

    private $damageFromBuffs = 0;

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
        $this->setType($type);
    }

    private function setType($type)
    {
        if ($type){
            $typeClassName = self::AVAILABLE_TYPES[$type];
            $this->type = new $typeClassName($this);
        }
    }

    public function equip( $inventoryItem )
    {
        $inventoryItemClassName = self::AVAILABLE_INVENTORY_ITEMS[$inventoryItem];
        $this->inventoryItems[$inventoryItem] = new $inventoryItemClassName($this);

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
            print_r(PHP_EOL. PHP_EOL. $this->getClassName() . " got $enemy->damage damage and blocked $this->armor! ". $this->getClassName()." HP left: $this->hitPoints\n");
        }

        if($enemy->type instanceof Vicious){
            $enemy->type->reducePosionByOne();
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
        $this->hitPoints = $this->calculateDamage($enemy);

        if ($this->type instanceof Veteran) {
            if(!$this->type->typeBuffWorks($this) && $this->hitPointsPercentage() < 30){
                $this->type->giveOwnerTypeBuff($this);
            }
        }
    }

    private function hasType( string $string )
    {
        return !empty($this->{$hasItem});
    }

    private function hitPointsPercentage()
    {
        return round(($this->hitPoints/$this->initialHitPoints) * 100);
    }

    private function calculateDamage(DuelistInterface $enemy) : int
    {
        if($enemy->type instanceof Vicious){
            if($enemy->type->typeBuffWorks($enemy)){
                // никто ничего не видел 🕵️
                $enemy->damage = 25;
            } else{
                $enemy->damage = 5;
            }
        }

        $hp = $this->hitPoints - ($enemy->damage - $this->armor);
        $hp = $hp > 0 ? $hp : 0;
        return $hp;
    }
}
