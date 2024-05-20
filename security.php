<?php
session_start();

include('config.php');

if($config)
{
    // echo "Database Connected";
}
else
{
    header("Location: config.php");
}

if(!$_SESSION['username'])
{
    header('location: index.php');
}

?>