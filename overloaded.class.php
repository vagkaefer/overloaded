<?php

class overloaded{

  public $type_msg = 'html';  //html, text   (file will be available in the next version)
  private $debug = false;      //false - true
  private $language = 'en';
  private $load;
  private $autoreload = 0; //the page reloads automatically in $autoreload seconds (only in output in html)

  function get_server_load() {  

    if (strpos(strtolower(PHP_OS), 'win') !== false){

      //if is a windows system
      $wmi = new COM("Winmgmts://");
      $server = $wmi->execquery("SELECT LoadPercentage FROM Win32_Processor");
      $cpu_num = 0;
      $load_total = 0;      
      foreach($server as $cpu){
          $cpu_num++;
          $load_total += $cpu->loadpercentage;
      }
      $load = round($load_total/$cpu_num);  

    } else {

      //if is a linux system
      $sys_load = sys_getloadavg();
      $load = $sys_load[0];

    }  
    
    return (int) $load;
  
  }//get_server_load end

  function show_msg(){

    if(!is_file('language/'.$this->language.'.php')){
      //language was not found, set the default
      $this->set_language('en');
    }

    //load the language
    require 'language/'.$this->language.'.php';

    if('html' == $this->type_msg){
      //html
      echo "<div style='text-align:center;'><h1>".OVERLOADED_MESSAGE."</h1></div>";
      if($autoreload > 0){
        echo "<meta http-equiv='refresh' content='".$autoreload."'>";
      }
    }else{
      //txt
      echo OVERLOADED_MESSAGE;
    }

  }//show_msg end

  function check($max_proces){

    if(!$debug){
      error_reporting(0); //Turn off all error reporting
    }

    $this->load = $this->get_server_load();

    if($this->load >= $max_proces){

      $this->show_msg(); //show the error message
      break;
    }    

  }//check end

  function set_language($newlanguage){

    //It is filtered to prevent users with less experience leave the system vulnerable
    $newlanguage = strip_tags($newlanguage);
    $newlanguage = str_replace('/','',$newlanguage);
    $newlanguage = str_replace('\\','',$newlanguage);
    $newlanguage = str_replace('.','',$newlanguage);
    $newlanguage = str_replace(',','',$newlanguage);

    $this->language = $newlanguage;

  }//set_language end 

  function set_autoreload($val){

    $this->autoreload = (int)$val;

  }//set_autoreload end

}//class end

?>