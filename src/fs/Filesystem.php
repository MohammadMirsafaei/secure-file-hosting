<?php

namespace FS;

use Models\File;

class Filesystem {

    public static function download(\Models\File $file, \Models\User $user): string
    {
        // TODO : connect acs
        return $file->content;
    }

    public static function upload(\Models\File $file, \Models\User $user)
    {
        // TODO : connect acs
        File::create($file->name,$file->content,$file->confLevel,$file->integLevel,$user->username);
    }

    public static function update(\Models\File $file, \Models\User $user, string $content)
    {
        // TODO : connect acs
        // $file->update($content);
    }

}