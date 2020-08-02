<?php

namespace Models;

use Database\Database;
class File {
    public $id;
    public $name;
    public $content;
    public $confLevel;
    public $integLevel;


    public static function create(string $name, string $content, string $confLevel, string $integLevel, string $user): bool
    {
        Database::command("insert into Files(name,content,conflevel,integlevel,username) values (:name,:content,:conflevel,:integlevel,:username)",
                            [
                                'name' => $name,
                                'content' => $content,
                                'conflevel' => $confLevel,
                                'integlevel' => $integLevel,
                                'username' => $user
                            ]);
        return true;
    }

    public function update(string $content)
    {
        Database::command("update Files set content=:content where id=:id",[
            'content' => $content,
            'id' => $this->id
        ]);
    }

    
}