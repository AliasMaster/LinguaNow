<?php
class Message
{
    private Bool $isError;
    private String $text;

    public function __construct(Bool $isError, String $text)
    {
        $this->isError = $isError;
        $this->text = $text;
    }

    public function printMessage(): void
    {
        $class = $this->isError ? 'undone' : 'done';
        echo "<div class=\"popOutMessage $class\">$this->text</div>";
    }
}
