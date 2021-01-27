<?php


class TextManager
{
    private array $baseTexts;
    private array $param;
    private string $language;

    public function __construct($language = "en")
    {
        $this->language = $language;
        $this->baseTexts = self::createBaseTexts();
    }

    public function getBaseText($key)
    {
        return $this->baseTexts[$key][$this->language];
    }

    public function addParam($key, $text)
    {
        $this->param[$key] = $text;
    }

    public function getParam($key)
    {
        return $this->param[$key];
    }

    private static function createBaseTexts()
    {
        return [
            "app-title" =>
                [
                    "de" => "BAD NOTES",
                    "en" => "BAD NOTES"
                ],
            "title" =>
                [
                    "de" => "Titel",
                    "en" => "Title"
                ],
            "note" =>
                [
                    "de" => "Notiz",
                    "en" => "Note"
                ],
            "save" =>
                [
                    "de" => "Speichern",
                    "en" => "Save"
                ],

        ];
    }
}