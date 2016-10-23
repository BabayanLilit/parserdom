<?php


namespace WS\Parser;

class Parser implements ParserInterface
{
    /**
     * @var
     */
    private $url;

    public function __construct($url)
    {

        $this->url = $url;
    }

    public function run()
    {

    }

    public function validate()
    {
        return true;
    }

}