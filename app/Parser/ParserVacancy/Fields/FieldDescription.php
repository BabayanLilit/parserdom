<?php

namespace WS\Parser\Fields;

use WS\Parser\ParserException;


class FieldDescription extends FieldAbstract
{
    const CODE = 'description';

    public static function getCode()
    {
        return static::CODE;
    }
}
