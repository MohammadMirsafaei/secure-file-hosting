<?php

use logger\Logger;

class AccessController
{
  private $integ_lvl = [
            'VeryTrusted' => 4 ,
            'Trusted' => 3 ,
            'SlightlyTrusted' => 2 ,
            'Untrusted' => 1
              ];
              private $conf_lvl = [
            'TopSecret' => 4 ,
            'Secret' => 3 ,
            'Confidential' => 2 ,
            'UnClassified' => 1
              ];



  public function __construct()
  {

  }
  //integrity
	private function checkBiBa($user_level,$file_level,$action){
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
	private function checkBLP($user_level,$file_level,$action){
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
    if(checkBiBa($integ_lvl[Auth::getAuthUser()->integLevel],$integ_lvl[$file_intg_level],"read" )
          && checkBLP($conf_lvl[Auth::getAuthUser()->confLevel],$conf_lvl[$file_conf_level],"read") ){

          return true;
    }
    else{ //log
      //$time = date("Y-m-d H:i:s", time()) ; 
    $temp_log= "User "+Auth::getAuthUser()->username +" <"+Auth::getAuthUser()->integLevel +","+Auth::getAuthUser()->confLevel+
                    "> "+ "tried to " + "read "+ $file_id->name +
                    " <"+$file_intg_level+","+$file_conf_level+"> "+"\taccess denied";
    Logger::log($temp_log);
    return false;
    }
    



	}

	public static function checkUpload($file_id){
    //how use query db
    $file_intg_level = $file_id->integLevel;
    $file_conf_level = $file_id->confLevel;
    if(checkBiBa($integ_lvl[Auth::getAuthUser()->integLevel],$integ_lvl[$file_intg_level],"write" )
          && checkBLP($conf_lvl[Auth::getAuthUser()->confLevel],$conf_lvl[$file_conf_level],"write") ){
          return true;
    }
    else{
       //$time = date("Y-m-d H:i:s", time()) ; 
    $temp_log= "User "+Auth::getAuthUser()->username +" <"+Auth::getAuthUser()->integLevel +","+Auth::getAuthUser()->confLevel+
    "> "+ "tried to " + "write on "+ $file_id->name +
    " <"+$file_intg_level+","+$file_conf_level+"> "+"\taccess denied";
    Logger::log($temp_log);
    return false;

    }
    // check

	}


}

