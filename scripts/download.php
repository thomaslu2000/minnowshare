<?php
    if(!isset($_POST['file_loc'])) trigger_error("No File Provided");
    $file = "../".$_POST['file_loc'];
    $filename = $_POST['filename'];

    if(!file_exists($file)) die("File Does Not Exist");

    $type = filetype($file);
    // Get a date and timestamp
    $today = date("F j, Y, g:i a");
    $time = time();
    // Send file headers
    header("Content-type: $type");
    header("Content-Disposition: attachment;filename=$filename");
    header("Content-Transfer-Encoding: binary"); 
    header('Pragma: no-cache'); 
    header('Expires: 0');
    // Send the file contents.
    set_time_limit(0); 
    readfile($file);
?>