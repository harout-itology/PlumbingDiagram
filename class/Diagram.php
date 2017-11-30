<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 11:27 AM
 */



class Diagram extends AbstractClass{

    public function get($conn){

        $sql = "SELECT *  FROM  `diagrams` ORDER BY `id` DESC ";
        $output = $conn->query($sql);
        return $output->fetchAll();

    }

    public function view($conn,$id){

        $sql = "SELECT *  FROM  `diagrams` where `id` = '$id' ";
        $output = $conn->query($sql);
        return $output->fetch();

    }



}