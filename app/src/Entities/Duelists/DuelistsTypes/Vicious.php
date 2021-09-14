<?php


namespace Tournament\Entities\Duelists\DuelistsTypes;


use Tournament\Entities\Duelists\DuelistInterface;

class Vicious implements DuelistTypeInterface
{
    private $poisonDamageBuff = 20;
    private $attacksCounter = 0;

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
        $this->usePoison();
    }

    public function usePoison(  )
    {
        $this->owner->buffParameter('damage', $this->poisonDamageBuff);

        if($this->attacksCounter == 2){
            $this->owner->debuffParameter('damage', $this->poisonDamageBuff);
        }
    }
}