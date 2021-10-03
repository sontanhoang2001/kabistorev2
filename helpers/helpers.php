<?php
function getRequestUrl()
{
    return $REQUEST_URI = substr($_SERVER['REQUEST_URI'], 11);
}
