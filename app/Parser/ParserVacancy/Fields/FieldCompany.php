<?php

namespace WS\Parser\Fields;

use WS\Parser\ParserException;


class FieldCompany extends FieldAbstract
{
    const CODE = 'company';

    public static function getCode()
    {
        return static::CODE;
    }
}
