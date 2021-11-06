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
