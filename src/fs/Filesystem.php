<?php

namespace FS;

use Logger\Logger;
use Models\File;
use ACS\AccessController;
use Auth\Auth;
class Filesystem {

    public static function download(\Models\File $file): bool
    {
        
        if(AccessController::checkDownload($file))
        {
            return true;

        }
        else {
            Logger::log("user ".Auth::getAuthUser()->username." tired to download file but stoped by ACS");
            return false;
        }
    }

    public static function upload(\Models\File $file, \Models\User $user)
    {
        if(AccessController::checkUpload($file))
        {
            return true;

        }
        else {
            Logger::log("user ".Auth::getAuthUser()->username." tired to upload file but stoped by ACS");
            return false;
        }
        
        //File::create($file->name,$file->content,$file->confLevel,$file->integLevel,$user->username);
    }

    public static function update(\Models\File $file, \Models\User $user, string $content)
    {
        // TODO : connect acs
        Logger::log("user {$user->username} tired to update file with id={$file->id} but stoped by ACS");
        // $file->update($content);
    }

}