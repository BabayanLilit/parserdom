<?php

namespace WS\Parser\Fields;

use WS\Parser\FieldErrorException;
use WS\Parser\ParserException;


abstract class FieldAbstract implements FieldInterface
{

    /**
     * @var string
     */
    protected $value;

    /**
     * FieldAbstract constructor.
     * @param $value
     */
    public function __construct($value)
    {

        $this->value = trim($value);
    }

    /**
     * @return bool
     */
    public function validate()
    {
        return true;
    }

    /**
     * @throws ParserException
     */
    public static function getCode()
    {
        throw new FieldErrorException('Не определен символьный код поля');
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $id
     * @param $value
     * @return FieldInterface|null
     */
    public static function factory($id, $value)
    {
        switch ($id) {
            case TasksCsvParser::FIELD_PROJECT_NUM : {
                return new ProjectField($value);

                break;
            }
            case TasksCsvParser::FIELD_BASE_TASK_NUM : {
                return new BaseTaskField($value);

                break;
            }

            case TasksCsvParser::FIELD_NAME_NUM : {
                return new NameField($value);

                break;
            }

            case TasksCsvParser::FIELD_TIME_NUM : {
                return new TimeField($value);

                break;
            }

            case TasksCsvParser::FIELD_DEADLINE_NUM : {
                return new DeadlineField($value);

                break;
            }

            case TasksCsvParser::FIELD_ORIGINATOR_NUM : {
                return new OriginatorField($value);

                break;
            }

            case TasksCsvParser::FIELD_RESPONSIBLE_NUM : {
                return new ResponsibleField($value);

                break;
            }

            case TasksCsvParser::FIELD_ACCOMPLICE_NUM : {
                return new AccompliceFieldMultiple($value);

                break;
            }

            case TasksCsvParser::FIELD_AUDITOR_NUM : {
                return new AuditorFieldMultiple($value);

                break;
            }

        }
    }

    public function getValueForSaving()
    {
        return $this->getValue();
    }
}