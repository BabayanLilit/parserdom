<?php

namespace WS\Parser\Fields;

use WS\Parser\FieldWarningException;
use WS\Parser\ParserException;


abstract class FieldDateAbstract extends FieldAbstract 
{

    const FORMAT_IN = '';


    public function validate()
    {
        if (!$this->getValue()) {
            return true;
        }

        if (!$this->checkDate()) {
            throw new FieldWarningException('Не верно заполнена дата - ', $this->getValue());
        }

        return true;
    }

    /**
     * @return bool
     */
    private function checkDate()
    {

    }

}
