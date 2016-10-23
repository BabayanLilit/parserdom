<?php

namespace WS\Parser;


use DB;

class InsertBehavior implements SavingBehaviorInterface
{
    public static function run(StorageData $storageData)
    {
        return DB::table($storageData->getTableName())->insert($storageData->getItems());
    }
}