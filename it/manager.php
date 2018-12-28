<?php
// key authenticationi
define('KEY_LIST', array("zsttq6543L", "Wsp6pQGEPp", "Tn8IgfmdkT", "V9ChbSvbvB", "RspVh2H8RI", "cJHCdWjrKi", "YnjbfX1kPU", "kWrq8GtWLO",  "QLd4nUC5f4", "HW3EYYBh6E", "yfUNQalGHe", "mVFr6VpBd9", "QiRCWGDJIG", "crouWalnlJ" ));
function docker_start($name, $date, $submission_number){
  // start a new docker instance without checking
  $mount_path = __DIR__ . "/feima";	
  $log_path = __DIR__ . "/log";
  $name_base = $name . "_" . $date . "_" . $submission_number;
  $zip_file = $mount_path . "/uploads/" . $name_base . ".zip";
  $log_file = $log_path . "/" . $name_base . ".txt";
  $shell_exe_str = "sudo docker run -d --rm --name " . $name .  " -v " . $mount_path . ":" . $mount_path " python36ml_it:v1 python " . $mount_path . "/read_data_compute_gain_NEW_NEW.py" . $zip_file . ">>" $log_file . "2>&1";
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
    $container_id = docker_start($key); 
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
