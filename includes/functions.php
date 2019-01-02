<?php

function returnTextIfPageMatches($text, $page) {
    return ($page == basename($_SERVER['PHP_SELF'], ".php")) ? $text : '';
}

function add_get_var($loc, $var_phrase){
    return $loc . ((strpos($loc, '?')) ? '&' : '?') . $var_phrase;
}

function close_connection_and_leave($loc, $m, $a=FALSE){
//        global $con;
        if ($con) mysqli_close($con);
        if($m) $loc = add_get_var($loc, "message=".$m);
        if($a) $loc .= "#".$a;
        header("Location: " . $loc);
    }

function get_file_type($file){
    $ext = strtolower(pathinfo($file)['extension']);
    if (in_array($ext, array('png', 'jpg', 'jpeg', 'gif', 'svg', 'bmp', 'ico', 'apng'))) return 'image';
    if (in_array($ext, array('doc', 'docx', 'log', 'msg', 'odt', 'pages', 'rtf', 'tex', 'txt'))) return 'text';
    if (in_array($ext, array('aif', 'm3u', 'm4a', 'mid', 'mp3', 'wav', 'wma'))) return 'audio';
    if (in_array($ext, array('avi', 'flv', 'm4v', 'mov', 'mp4', 'mpg', 'srt', 'wmv'))) return 'video';
    if (in_array($ext, array('apk','app', 'bat', 'com', 'exe', 'jar'))) return 'executable';
    if (in_array($ext, array('7z', 'gz', 'pkg', 'rar', 'tar.gz', 'zip', 'zipx'))) return 'compressed';
    if (in_array($ext, array('epub', 'mobi', 'azw', 'azw3', 'iba', 'pdf'))) return 'ebook';
    return 'unknown';
}

function setUser($uid, $uname){
    if (session_status() == PHP_SESSION_NONE) session_start();
    $_SESSION['userid'] = $uid;
    $_SESSION['username'] = $uname;
    setcookie("userid", $uid, time() + (86400*30), "/");
    setcookie("username", $uname, time() + (86400*30), "/");
}

?>