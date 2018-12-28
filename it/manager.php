<?php
// key authenticationi
define('KEY_LIST', array("zsttq6543L", "Wsp6pQGEPp", "Tn8IgfmdkT", "V9ChbSvbvB", "RspVh2H8RI", "cJHCdWjrKi", "YnjbfX1kPU", "kWrq8GtWLO",  "QLd4nUC5f4", "HW3EYYBh6E", "yfUNQalGHe", "mVFr6VpBd9", "QiRCWGDJIG", "crouWalnlJ" ));
function docker_start($name, $date, $submission_number){
  // start a new docker instance with basic checking
  // if -1 is returned, the zip file is not on the server, upload should be done first
  $mount_path = __DIR__ . "/feima";	
  $log_path = __DIR__ . "/log";
  $name_base = $name . "_" . $date . "_" . $submission_number;
  $zip_file = $mount_path . "/uploads/" . $name_base . ".zip";
  if(!file_exists($zip_file)){
    return -1;
  }
  $log_file = $log_path . "/" . $name_base . ".txt";
  $shell_exe_str = "sudo docker run -d --rm --name " . $name .  " -v " . $mount_path . ":" . $mount_path . " python36ml_it:v1 python " . $mount_path . "/read_data_compute_gain_NEW_NEW.py" . $zip_file . ">>" . $log_file . "2>&1";
  $container_id = shell_exec($shell_exe_str);   
  return $container_id;
}
function docker_stop($name){
  // kill the running docker container without checking
  $shell_exe_str = "sudo docker kill " . $name;
  $returned_name = shell_exec($shell_exe_str);
  return $returned_name;
}
function docker_status($name){
  // only check the running docker
  // return value chooses from ['STOP', 'RUNNING']
  $shell_exe_str = "sudo docker ps";
  $csv_str = shell_exec($shell_exe_str);
  $container_list = explode("\n", $csv_str);
  $num_container = count($container_list);
  for($i = 1; $i < $num_container; $i++){
    if(strpos($container_list[$i], $name))
      return "RUNNING"; 
  }
  return "STOP";
}
function check_date($date_str){
  // check the date is between 20181201 - 20181230
  $start = strtotime("20181201");
  $end = strtotime("20181230");
  $check_date = strtotime($date_str);
  return ($start <= $check_date) && ($check_date <= $end);
}
function check_submission_number($submission_number){
  // check that the submission_number is between 0 and 50
  $submission_num = intval($submission_number);
  return (0 <= $submission_num) && ($submission_num <= 50);
}
function check_key($name){
  // check whether $name is within KEY_LIST
  foreach(KEY_LIST as $key){
    if($name == $key)
      return true;
  }
  return false;
}
$key = $_GET["key"];
if(!isset($key)){
 die("key error");
}
elseif(!check_key($key)){
 die("incorrect key");
}
$command = $_GET["command"];
if($command == 'start'){
  // first check if there is any instance named with $key is on
  if(docker_status($key) == "RUNNING"){ 
    echo "docker " . $key . " already started <br/>";
  }
  else{
    $submission_number = $_GET["sn"];
    $date_str = $_GET["date"];
    if(!check_date($date_str)){
      die("invalid get parameter date = " . $date_str);
    }
    elseif(!check_submission_number($submission_number)){
      die("invalid get parameter sn = " . $submission_number);
    } 
    $container_id = docker_start($key, $date_str, $submission_number); 
    if($container_id == -1){
      die("requested resource not on the server, upload it first");
    }
    echo "docker started...<br/>";
    echo "container id = " . $container_id . "<br/>";
  }
}
elseif($command == "status"){
  echo docker_status($key);
}
elseif($command == "stop"){
  if(docker_status($key) == "RUNNING"){
    $returned_key = docker_stop($key);
    echo "docker " . $returned_key . " stoped<br/>";
  }
  else{
    echo "docker " . $key . " not started yet<br/>";
  }
}
?>
