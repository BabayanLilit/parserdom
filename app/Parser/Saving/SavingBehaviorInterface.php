<?php

namespace WS\Parser;


interface SavingBehaviorInterface
{
    public static function run(StorageData $storageData);
}