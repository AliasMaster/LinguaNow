<?php
class Course
{
    public int $id;
    public String $name;
    public String $description;

    public function __construct(int $id, String $name, String $description = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
}
