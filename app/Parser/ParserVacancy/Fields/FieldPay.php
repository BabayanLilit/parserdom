<?php

namespace WS\Parser\Fields;

use WS\Parser\ParserException;


class FieldPay extends FieldAbstract
{
    const CODE = 'pay';

    public static function getCode()
    {
        return static::CODE;
    }
}
