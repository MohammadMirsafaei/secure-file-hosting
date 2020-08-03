<?php

namespace Models;

use Database\Database;
class File {
    public $id;
    public $name;
    public $content;
    public $confLevel;
    public $integLevel;
    public $username;


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

    public static function all(): array
    {
        $files = Database::select("select * from Files");
        $retFiles = [];
        foreach ($files as $key => $value) {
            $file = new File();
            $file->content = $value['content'];
            $file->name = $value['name'];
            $file->id = $value['id'];
            $file->integLevel = $value['integlevel'];
            $file->confLevel = $value['conflevel'];
            $file->username = $value['username'];
            array_push($retFiles,$file);
        }
        return $retFiles;
    }
  
    public static function getFileById(int $id)
    {
        $value = Database::select("select * from Files where id={$id}")[0];
        $file = new File();
        $file->content = $value['content'];
            $file->name = $value['name'];
            $file->id = $value['id'];
            $file->integLevel = $value['integlevel'];
            $file->confLevel = $value['conflevel'];
            $file->username = $value['username'];
	$ret = $file;
        return $ret;
    }

    
}
