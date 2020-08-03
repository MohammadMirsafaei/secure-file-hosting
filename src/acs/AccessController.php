<?php

namespace ACS;

use logger\Logger;
use Auth\Auth;
class AccessController
{
  private static $integ_lvl = [
            'VeryTrusted' => 4 ,
            'Trusted' => 3 ,
            'SlightlyTrusted' => 2 ,
            'Untrusted' => 1
              ];
              private static $conf_lvl = [
            'TopSecret' => 4 ,
            'Secret' => 3 ,
            'Confidential' => 2 ,
            'UnClassified' => 1
              ];



  public function __construct()
  {

  }
  //integrity
	private static function checkBiBa($user_level,$file_level,$action){
        if($action=="read"){
          if ($user_level<=$file_level) return true;
          else return false;
        }
        elseif($action=="write"){
          if ($user_level>=$file_level) return true;
          else return false;
        }
        else{
          //error
        }

	}
//conf
	private static function checkBLP($user_level,$file_level,$action){
    if($action=="read"){
      if ($user_level>=$file_level) return true;
      else return false;
    }
    elseif($action=="write"){
      if ($user_level<=$file_level) return true;
      else return false;
    }
    else{
      //error
    }

	}

  public static function checkDownload($file_id){
    //how use query db
    $file_intg_level = $file_id->integLevel;
    $file_conf_level = $file_id->confLevel;
    if(self::checkBiBa(self::$integ_lvl[Auth::getAuthUser()->integLevel],self::$integ_lvl[$file_intg_level],"read" )
          && self::checkBLP(self::$conf_lvl[Auth::getAuthUser()->confLevel],self::$conf_lvl[$file_conf_level],"read") ){

          return true;
    }
    
    else{ //log
      //$time = date("Y-m-d H:i:s", time()) ; 
    $temp_log= "User ".Auth::getAuthUser()->username ." <".Auth::getAuthUser()->integLevel .",".Auth::getAuthUser()->confLevel.
                    "> ". "tried to " . "read ". $file_id->name .
                    " <".$file_intg_level.",".$file_conf_level+"> "."\taccess denied";
    \Logger\Logger::log($temp_log);

    return false;
    }
    



	}

	public static function checkUpload($file_id){
    //how use query db
    $file_intg_level = $file_id->integLevel;
    $file_conf_level = $file_id->confLevel;
    if(self::checkBiBa(self::$integ_lvl[Auth::getAuthUser()->integLevel],self::$integ_lvl[$file_intg_level],"write" )
          && self::checkBLP(self::$conf_lvl[Auth::getAuthUser()->confLevel],self::$conf_lvl[$file_conf_level],"write") ){
          return true;
    }
    else{
       //$time = date("Y-m-d H:i:s", time()) ; 
    $temp_log= "User ".Auth::getAuthUser()->username ." <".Auth::getAuthUser()->integLevel .",".Auth::getAuthUser()->confLevel.
    "> ". "tried to " . "write on ". $file_id->name .
    " <".$file_intg_level.",".$file_conf_level."> "."\taccess denied";
    \Logger\Logger::log($temp_log);
    return false;

    }
    // check

	}


}

