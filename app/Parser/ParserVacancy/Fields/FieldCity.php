<?php

namespace WS\Parser\Fields;

use WS\Parser\FieldWarningException;
use WS\Parser\ParserException;


class FieldCity extends FieldAbstract
{
    const CODE = 'city_id';

    public static function getCode()
    {
        return static::CODE;
    }

    /**
     * @var int
     */
    protected $cityId = 0;


    public function validate()
    {
        if (!$this->getValue()) {
            return true;
        }

        if (!$this->cityId = $this->findCityId()) {
            throw new FieldWarningException('Не определен город' . $this->getValue());
        }

        return true;
    }

    private function findCityId()
    {

    }

    public function getValueForSaving()
    {
        return $this->cityId;
    }
}
