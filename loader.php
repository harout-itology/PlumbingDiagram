<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 11:39 AM
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('config/db.php');
$conn = data_connect($servername,$db,$username,$password);

spl_autoload_register(function ($class_name) {  include 'class/'.$class_name . '.php'; });