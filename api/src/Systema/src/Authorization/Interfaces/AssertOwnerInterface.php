<?php


namespace Systema\Authorization\Interfaces;

interface AssertOwnerInterface
{

    public function setLoginId(): void;
    public function getLoginId(): int;

    /**
     * Se torna true, l'ownership viene skippato
     *
     * @return bool
     */
    public function isAlwaysGranted(): bool;


}