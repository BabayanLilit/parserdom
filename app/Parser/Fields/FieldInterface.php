<?php

namespace WS\Parser\Fields;

/**
 * Interface FieldInterfaceGeneral
 * @package WS\Parser\Fields
 */
interface FieldInterface
{
    public function validate();
    public static function getCode();
    public function getValueForSaving();
}