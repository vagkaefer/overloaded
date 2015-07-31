<?php

class overloaded{

  public $type_msg = 'html';  //html, text   (file will be available in the next version)
  public $debug = false;      //available in the next version
  public $language = 'pt-br'; //available in the next version
  public $load;

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

    if('html' == $this->type_msg){
      //html
      echo "<div style='text-align:center;'><h1>Ops, the server is overloaded! Try again in a few minutes (".$this->load.")</h1></div>";
    }else{
      //txt
      echo "Ops, the server is overloaded! Try again in a few minutes (".$this->load.")";
    }

  }//show_msg end

  function check($max_proces){

    $this->load = $this->get_server_load();

    if($this->load >= $max_proces){

      error_reporting(0); //Turn off all error reporting
      $this->show_msg(); //show the error message
      break;
    }    

  }//check end

}//class end

?>