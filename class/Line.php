<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 11:27 AM
 */



class Line extends AbstractClass{

    public function get($conn){

        $sql = "SELECT *  FROM  `lines` ORDER BY `id` DESC ";
        $output = $conn->query($sql);
        return $output->fetchAll();

    }

    public function set($conn,$post){

        $date= date('Y-m-d H:i:s');
        $sql = "INSERT INTO `lines` (`color`, `size`, `type`, `status`, `notes`, `created` )  VALUES 
               ('$post[color]','$post[size]','$post[type]','$post[status]','$post[notes]','$date' ) ";
        return $conn->exec($sql);

    }

    public function view($conn,$id){

        $sql = "SELECT *  FROM  `lines` where `id` = '$id' ";
        $output = $conn->query($sql);
        return $output->fetch();

    }

    public function edit($conn,$post){

        $date= date('Y-m-d H:i:s');
        $sql = "UPDATE `lines` SET `color` = '$post[color]', `size` = '$post[size]' , `type` = '$post[type]',`status` = '$post[status]',`notes` = '$post[notes]',`updated` = '$date'  where  `id` =  '$post[id]' ";
        $conn->exec($sql);
        return $post;

    }

    public function delete($conn,$id){

        $sql = "DELETE  FROM  `lines` where `id` = '$id' ";
        return $conn->exec($sql);

    }

}