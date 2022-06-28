<?php

session_start();

include("../connections.php");

if(isset($_GET['link']))
{
    $value = $_GET['link'];
    $flag = delete("delete from course where id=$value");
    if($flag == 1 )
    {
        delete("delete from playlist where cid=$value");
        //echo "Course Deleted!";
        header("Location: http://localhost/Course/Admin/viewCourse.php");
        exit();
    }
    else{
        echo "Failed!";
        header("Location: http://localhost/Course/Admin/viewCourse.php");
        exit();
    }
}

if(isset($_GET['id']))
{
    $value = $_GET['id'];
    $var = get("select * from playlist where id=$value");
    $flag = delete("delete from playlist where id=$value");
    if($flag == 1 )
    {
        header('Location: http://localhost/Course/Admin/viewPlaylist.php?id='.$var['cid']);
        exit();
    }
    else{
        echo "Failed!";
        header("Location: http://localhost/Course/Admin/viewCourse.php");
        exit();
    }
}