<?php

class AccessController extend Auth , Logger
{
    const $integ_lvl = [
            "VeryTrusted" => 4 ,
            "Trusted" => 3 ,
            "SlightlyTrusted" => 2 ,
            "Untrusted" => 1
              ];
    const $conf_lvl = [
            "TopSecret" => 4 ,
            "Secret" => 3 ,
            "Confidential" => 2 ,
            "UnClassified" => 1
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

  public function checkDownload($file_id){
    //how use query db
    $file_intg_level;
    $file_conf_level;
    // check



	}

	public function checkUpload($file_id){
    //how use query db
	}


}
