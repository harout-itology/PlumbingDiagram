<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 11:27 AM
 */



class Port extends AbstractClass{

    public function get($conn,$shape_id){

        $sql = "SELECT *  FROM  `ports` WHERE `shape_id` = '$shape_id' ";
        $output = $conn->query($sql);
        return $output->fetchAll();
    }

    public function edit($conn,$post){

        if(isset($post['id'])){
            $date= date('Y-m-d H:i:s');
            for($i=0; $i<count($post['id']); $i++){
                $id = $post['id'][$i];
                $name = $post['name'][$i];
                $type = $post['type'][$i];
                $color = $post['color'][$i];
                $shape_id =$post['shape_id'];
                if($post['id'][$i] == 0){
                    // create
                    $sql = "INSERT INTO `ports` (`shape_id`, `name`, `type`, `color`, `created` )  VALUES 
                   ('$shape_id','$name','$type','$color','$date' ) ";
                    $conn->exec($sql);
                }
                elseif($post['id'][$i] < 0){
                    // delete
                    $id = $id * -1;
                    $sql = "DELETE  FROM  `ports` where `id` = '$id' ";
                    $conn->query($sql);
                }
                elseif($post['id'][$i] > 0){
                    // edit
                    $sql = "UPDATE `ports` SET `name` = '$name', `type` = '$type',`color` = '$color',`updated` =  '$date'  WHERE  `id` =  '$id' ";
                    $conn->exec($sql);
                }

            }
        }

    }



}