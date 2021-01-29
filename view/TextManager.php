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

    public function hasParam($key)
    {
        return isset($this->param[$key]);
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
            "saved" =>
                [
                    "de" => "Gespeichert",
                    "en" => "Saved"
                ],
            "create-note" =>
                [
                    "de" => "Notiz hinzufügen",
                    "en" => "Create Note"
                ],
            "delete" =>
                [
                    "de" => "Löschen",
                    "en" => "Delete"
                ],
            "unknown-error" =>
                [
                    "de" => "Unbekannter Fehler",
                    "en" => "Unknown Error"
                ],
            "cancel" =>
                [
                    "de" => "Abbrechen",
                    "en" => "Cancel"
                ],
            "delete-note" =>
                [
                    "de" => "Notiz löschen",
                    "en" => "Delete Note"
                ],
            "really-delete-note" =>
                [
                    "de" => "Bist du sicher, dass du die Notiz löschen möchtest? Du kannst diesen Vorgang nicht mehr rückgängig machen!",
                    "en" => "Are you sure you want to delete the note? You can not undo this action!"
                ],
        ];
    }
}