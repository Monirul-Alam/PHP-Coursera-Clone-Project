<?php

    function passEncrypt($value)
    {
        $conn = mysqli_connect('localhost','root','','coursemanagement');
        $pass = mysqli_real_escape_string($conn, $value);
        $pass = md5($pass);
        return $pass;
    }
    
    function get($query)
    {
        $conn = mysqli_connect('localhost','root','','coursemanagement');
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data;
    }
    function gets($query)
    {
        $conn = mysqli_connect('localhost','root','','coursemanagement');
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function rows($query)
    {
        $conn = mysqli_connect('localhost','root','','coursemanagement');
        $result = mysqli_query($conn, $query);
        $data = mysqli_num_rows($result);
        return $data;
    }

    function insert($query)
    {
        $conn = mysqli_connect('localhost','root','','coursemanagement');
        $result = mysqli_query($conn, $query);
        return $result;
    }
    function update($query)
    {
        $conn = mysqli_connect('localhost','root','','coursemanagement');
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function delete($query)
    {
        $conn = mysqli_connect('localhost','root','','coursemanagement');
        $result = mysqli_query($conn, $query);
        return $result;
    }



?>