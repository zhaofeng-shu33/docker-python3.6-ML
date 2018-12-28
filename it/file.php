<?php
header('Content-Type:application/json');
$files = scandir(__DIR__ . "/feima/uploads");
$qualified_zip_files = array();
foreach($files as $file_name){
    if(strpos($file_name, '.zip') === false){
        continue;
    }
    elseif(strpos($file_name, $key) === false){
        continue;
    }
    $timestamp = filectime("feima/uploads/" . $file_name);
    $qualified_zip_files[] = array(
        "name" => $file_name,
        "size" => filesize("feima/uploads/" . $file_name),
        "time" => date("Y-m-d H:i:s", $timestamp)
        );
}
echo json_encode($qualified_zip_files);
?>
