<?php

namespace WS\Parser\Fields;


use WS\Parser\FieldWarningException;

abstract class FieldIntegerAbstract extends FieldAbstract
{

    public function validate()
    {
        if (!$this->getValue()) {
            return true;
        }

        if (!$this->isIntNumeric()) {
            throw new FieldWarningException('Значение поля не является целым числом');
        }

        return true;
    }

    protected function isIntNumeric()
    {
        if (!is_numeric($this->value)) {
            return false;
        }

        return ((float) $this->value) == ((int) $this->value);
    }

    public function getValueForSaving()
    {
        return (int) $this->getValue();
    }
}