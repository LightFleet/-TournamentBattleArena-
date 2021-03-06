<?php


namespace Tournament\Entities\Duelists;


use Tournament\Interactors\DuelInteractor;
use Tournament\Interactors\DuelInteractorInterface;

interface DuelistInterface
{
    public function __construct($type);

    public function engage(DuelistInterface $enemy);

    public function equip($inventoryItem);

    public function hitPoints(): int;

    public function getPunch(DuelistInterface $enemy);

    public function isAlive(): bool;

    public function canAttackThisTurn(): bool;
}