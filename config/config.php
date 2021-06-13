<?php
ob_start();     //Zapne output buffering
session_start();

$timezone = date_default_timezone_set("Europe/Prague");

$con = mysqli_connect("localhost", "uzivatel", "heslo", "mujwebdb");
if(mysqli_connect_errno()){
    echo "Nepodařilo se připojit: " . mysqli_connect_errno();
}
?>