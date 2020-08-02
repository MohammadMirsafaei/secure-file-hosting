<?php

namespace Models;

use Database\Database;

class Log {

    public $id;
    public $datetime;
    public $content;

    public static function create(string $log)
    {
        Database::command("insert into Logs(content) values(:content)",
                            [
                                'content' => $log
                            ]);
    }

    public static function all(): array 
    {
        $logs = Database::select("select * from Logs");
        $retLog = [];
        foreach ($logs as $key => $value) {
            $log = new Log();
            $log->content = $value['content'];
            $log->datetime = $value['dt'];
            $log->id = $value['id'];
            array_push($retLog,$log);
        }
        return $retLog;
    }
}