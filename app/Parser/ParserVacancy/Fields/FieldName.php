<?php

namespace WS\Parser\Fields;

use WS\Parser\FieldErrorException;
use WS\Parser\ParserException;


class FieldName extends FieldAbstract
{
    const CODE = 'name';

    public static function getCode()
    {
        return static::CODE;
    }

    public function validate()
    {
        if (!$this->getValue()) {
            throw new FieldErrorException('Не задано название вакансии');
        }
    }
}
