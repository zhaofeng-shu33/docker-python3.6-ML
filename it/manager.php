<?php
// key authenticationi
define('KEY_LIST', array("a9542bb104fe3f4d562e1d275e03f5ba", "2ad0c6e57f2552cf4b296a3d6dfa93f1"));
function docker_start($name){
  // start a new docker instance without checking
  $shell_exe_str = "docker run -d --rm --name " . $name .  " -v " .  __DIR__ . "/" . $name . ":/dist/model python36ml_mnist:v4 python run.py";
  $container_id = shell_exec($shell_exe_str);   
  return $container_id;
}
function docker_stop($name){
  // kill the running docker container without checking
  $shell_exe_str = "docker kill " . $name;
  $returned_name = shell_exec($shell_exe_str);
  return $returned_name;
}
function docker_status($name){
  // only check the running docker
  // return value chooses from ['STOP', 'RUNNING']
  $shell_exe_str = "docker ps";
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
// directory initialization
if(!file_exists($key)){
  if(mkdir($key)){
    echo "initialize the directory for key = " . $key . "...<br/>";
  }
  else{
    echo "make dir failed";
  }
}
// uploader copy
$upload_php = $key . "/upload.php";
if(!file_exists($upload_php)){
  if(copy("upload.php", $upload_php)){
    echo "copy upload.php to user directory<br/>";
  }
  else{
    echo "copy failed";
  }
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
