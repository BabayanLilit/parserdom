<?php

namespace WS\Parser\Fields;

use WS\Parser\FieldErrorException;
use WS\Parser\ParserException;


class FieldExternalId extends FieldIntegerAbstract
{
    const CODE = 'external_id';

    public static function getCode()
    {
        return static::CODE;
    }

    public function validate()
    {
        if (!$this->getValue()) {
            throw new FieldErrorException('Не задан внешний идентификатор вакансии');
        }

        try {
            parent::validate();
        } catch (FieldErrorException $e) {
            throw new FieldErrorException('Неверно задан внещний идентификатор вакансии');
        }

        return true;
    }
}
