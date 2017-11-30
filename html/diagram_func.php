<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 11:42 PM
 */

include ('../loader.php');

if($_POST['id']){
    $diagram = new Diagram();
    echo $diagram->edit($conn, $_POST);
}
else {
    $diagram = new Diagram();
    echo $diagram->set($conn, $_POST);
}