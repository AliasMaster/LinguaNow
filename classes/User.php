<?php
class User {
    public int $id;
    public String $fname;
    public String $lname;
    public String $email;
    public int $accessLevel;

    public function __construct(int $id, String $fname, String $lname, String $email, int $accessLevel) {
        $this->id = $id;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->accessLevel = $accessLevel;
    }
}