<?php

namespace WS\Parser\Fields;

use WS\Parser\ParserException;


class FieldDate extends FieldDateAbstract
{
    const CODE = 'date';

    public static function getCode()
    {
        return static::CODE;
    }


}
