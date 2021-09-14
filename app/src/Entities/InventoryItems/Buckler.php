<?php
namespace Tournament\Entities\InventoryItems;

use Tournament\Entities\Duelists\DuelistInterface;
use Tournament\Entities\InventoryItems\InventoryItemInterface;

class Buckler implements InventoryItemInterface
{
    private $owner;
    public $canBlockHit = true;
    public $health = 3;

    public function __construct( DuelistInterface $owner )
    {
        $this->owner = $owner;
        $this->modifyOwner();
    }

    public function modifyOwner(  )
    {
        $this->owner->hasBuckler = true;
    }

    public function getHit(){

        $this->health -= 1;

        if($this->health <= 0){
            $this->owner->hasBuckler = false;
        }
    }
}
