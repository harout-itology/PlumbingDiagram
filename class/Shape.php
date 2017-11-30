<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 11:27 AM
 */



class Shape extends AbstractClass{

    public function get($conn){

        $sql = "SELECT *  FROM  `shapes` ORDER BY `id` DESC ";
        $output = $conn->query($sql);
        return $output->fetchAll();

    }

    public function set($conn,$post){

        $date= date('Y-m-d H:i:s');
        $sql = "INSERT INTO `shapes` (`name`, `type`, `width`, `height`, `background`, `color`, `created` )  VALUES 
               ('$post[name]','$post[type]','$post[width]','$post[height]','$post[background]','$post[color]','$date' ) ";
        return $conn->exec($sql);

    }

    public function view($conn,$id){

        $sql = "SELECT *  FROM  `shapes` where `id` = '$id' ";
        $output = $conn->query($sql);
        return $output->fetch();

    }

    public function edit($conn,$post){

        $date= date('Y-m-d H:i:s');
        $sql = "UPDATE `shapes` SET `name` = '$post[name]', `type` = '$post[type]',`width` = '$post[width]',`height` = '$post[height]',`background` = '$post[background]',`color` = '$post[color]',`updated` = '$date'  where  `id` =  '$post[id]' ";
        $conn->exec($sql);
        return $post;

    }

    public function delete($conn,$id){

        $sql = "DELETE  FROM  `shapes` where `id` = '$id' ";
        $output = $conn->query($sql);
        return $conn->exec($sql);

    }

}