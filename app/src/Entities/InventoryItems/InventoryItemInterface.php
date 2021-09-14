<?php


namespace Tournament\Entities\InventoryItems;


use Tournament\Entities\Duelists\DuelistInterface;

interface InventoryItemInterface
{
    public function __construct(DuelistInterface $owner);

    public function modifyOwner();
}