<?php
// lấy url product
function getRequestUrl()
{
    return $REQUEST_URI = substr($_SERVER['REQUEST_URI'], 11);
}

// sửa dụng cho tất cả
function getRequestUrls()
{
    return $REQUEST_URI = substr($_SERVER['REQUEST_URI'], 0);
}


function md5ToString($md5)
{
    include "../lib/Snoopy.class.php";
    require "../lib/simple_html_dom.php";
    $snoopy = new Snoopy;
    $snoopy->fetch("https://md5.gromweb.com/?md5=" . $md5);

    $snoopyRes = $snoopy->results;
    $html = str_get_html($snoopyRes);

    return $html->find("em", 1);
}
?>