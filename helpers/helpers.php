<?php
function getRequestUrl()
{
    return $REQUEST_URI = substr($_SERVER['REQUEST_URI'], 11);
}

function getRequestUrls()
{
    return $REQUEST_URI = substr($_SERVER['REQUEST_URI'], 0);
}
