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

    public function set($conn,$post){

        $date= date('Y-m-d H:i:s');
        $content = json_decode($post['content']);

        foreach ($content->linkDataArray as $item){
            unset($item->points);
        }
        $content = json_encode($content);
        $post['name'] ? $name = $post['name'] : $name = $date;

        $sql = "INSERT INTO `diagrams` (`name`, `content`, `image`, `created` )  VALUES 
               ('$name','$content','$post[image]','$date' ) ";
        $conn->exec($sql);
        return $conn->lastInsertId();

    }

    public function edit($conn,$post){

        $date= date('Y-m-d H:i:s');
        $content = json_decode($post['content']);

        foreach ($content->linkDataArray as $item){
            unset($item->points);
        }
        $content = json_encode($content);
        $post['name'] ? $name = $post['name'] : $name = $date;

        $sql = "UPDATE `diagrams` SET `name` = '$name', `content` = '$content',`image` = '$post[image]',`updated` = '$date'  where  `id` =  '$post[id]' ";
        $conn->exec($sql);


        return $post['id'];

    }



}