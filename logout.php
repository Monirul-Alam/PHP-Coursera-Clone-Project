<?php

if(session_status() >= 0)
{
    session_start();
    session_unset();
    session_destroy();
    header("Location: Login.php");
    exit();
}