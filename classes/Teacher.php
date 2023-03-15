<?php
class Teacher
{
    public string $name;
    public String $description;
    public String $img;

    public function __construct(String $name, String $description, String $img)
    {
        $this->name = $name;
        $this->description = $description;
        $this->img = $img;
    }
}
