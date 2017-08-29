<?php
error_reporting(0);
/* Custem Paths Files Css And Js */
$Css = "css/"; # Path Folder Css
$Js = "js/";   # Path Folder Js

# Array Config Contains Folders Css And Js
$config = array(
    'Css' => array('materialize.min.css','font-awesome.min.css','style.css'),
    'Js'  => array('jquery-1.12.4.min.js','materialize.min.js','main.js')
);

require_once(__DIR__.'/include/header.php'); // Include Header
