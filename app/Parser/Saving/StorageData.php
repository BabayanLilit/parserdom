<?php

namespace WS\Parser;


use DB;

class StorageData
{
    protected $countInIteration = 25;
    protected $currentCount = 0;

    /**
     * @var []
     */
    protected $items = [];

    /**
     * @var string
     */
    protected $tableName;
    /**
     * @var SavingBehaviorInterface
     */
    private $behavior;

    public function __construct($tableName, SavingBehaviorInterface $behavior)
    {
        $this->tableName = $tableName;
        $this->behavior = $behavior;
    }

    public function addItem($item)
    {
        $this->items[] = $item;
        $this->currentCount++;

        if ($this->currentCount == $this->countInIteration) {
            $this->run();
        }
    }

    protected function clear()
    {
        $this->items = [];
        $this->currentCount = 0;
    }

    protected function run()
    {
        $result = $this->behavior->run($this);
        $this->clear();
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @return ModelRow[]
     */
    public function getItems()
    {
        return $this->items;
    }
}