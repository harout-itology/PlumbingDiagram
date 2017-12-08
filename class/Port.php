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

    public function get_list($conn){

        $sql = "SELECT *  FROM  `ports`  WHERE `location` = 'Top' ";
        $output = $conn->query($sql);
        $Top =  $output->fetchAll();
        $sql = "SELECT *  FROM  `ports`  WHERE `location` = 'Right' ";
        $output = $conn->query($sql);
        $Right =  $output->fetchAll();
        $sql = "SELECT *  FROM  `ports`  WHERE `location` = 'Bottom' ";
        $output = $conn->query($sql);
        $Bottom =  $output->fetchAll();
        $sql = "SELECT *  FROM  `ports`  WHERE `location` = 'left' ";
        $output = $conn->query($sql);
        $left =  $output->fetchAll();

        return ['Top'=>$Top,'Right'=>$Right,'Bottom'=>$Bottom,'Left'=>$left];

    }


    public function edit($conn,$post){

        if(isset($post['id'])){
            $date= date('Y-m-d H:i:s');
            for($i=0; $i<count($post['id']); $i++){
                $id = $post['id'][$i];
                $name = $post['name'][$i];
                $location = $post['location'][$i];
                $color = $post['color'][$i];
                $shape_id =$post['shape_id'];
                if($post['id'][$i] == 0){
                    // create
                    $sql = "INSERT INTO `ports` (`shape_id`, `name`, `location`, `color`, `created` )  VALUES 
                   ('$shape_id','$name','$location','$color','$date' ) ";
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
                    $sql = "UPDATE `ports` SET `name` = '$name', `location` = '$location' ,`color` = '$color',`updated` =  '$date'  WHERE  `id` =  '$id' ";
                    $conn->exec($sql);
                }

            }
        }

    }



}