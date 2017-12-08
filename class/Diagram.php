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
        $diagram = $conn->query($sql);
        $diagram =  $diagram->fetch();

        $sql = "SELECT *  FROM  `diagram_shape` where `diagram_id` = '$id' ";
        $shapes = $conn->query($sql);
        $shapes =  $shapes->fetchAll();

        foreach ($shapes as $item){
            $array['category'] = $item['category'];
            $array['key'] = $item['key'];
            $array['loc'] = $item['loc'];

            // add ports
            $sql = "SELECT *  FROM  `ports` where `shape_id` = '$item[category]' ";
            $ports = $conn->query($sql);
            $ports =  $ports->fetchAll();
            foreach ($ports as $port){
                $arr['portColor']= $port['color'];
                $arr['portId']= $port['id'];
                $array[$port['location']] = [$arr];
            }


            $shapes_out[] = $array;
        }

        return ['diagram'=>$diagram,'shapes'=>$shapes_out];

    }

    public function set($conn,$post){

        $date= date('Y-m-d H:i:s');
        $content = json_decode($post['content']);

        // delete shapes points
        foreach ($content->linkDataArray as $item){
            unset($item->points);
        }

        // diagram main data
        $sector = $post['sector'];
        $width = $post['width'] ? $post['width'] : 0;
        $height = $post['height'] ? $post['height'] : 0;
        $background = $post['background'];
        $image = $post['image'];
        $sql = "INSERT INTO `diagrams` (`sector`,  `width`, `height`, `background`, `image`, `created` )  VALUES 
               ('$sector','$width','$height','$background','$image','$date' ) ";
        $conn->exec($sql);
        $id = $conn->lastInsertId();

        // shapes
        foreach ($content->nodeDataArray as $item){
            $category = $item->category;
            $key = $item->key;
            $loc = $item->loc;
            $sql = "INSERT INTO `diagram_shape` (`diagram_id`, `category`, `key`, `loc` )  VALUES 
                   ('$id','$category','$key','$loc') ";
            $conn->exec($sql);
        }

        return $id;

    }

    public function edit($conn,$post){

        $date= date('Y-m-d H:i:s');
        $content = json_decode($post['content']);

        // delete shapes points
        foreach ($content->linkDataArray as $item){
            unset($item->points);
        }

        // diagram main data
        $id = $post['id'];
        $sector = $post['sector'];
        $width = $post['width'];
        $height = $post['height'];
        $background = $post['background'];
        $image = $post['image'];
        $sql = "UPDATE `diagrams` SET `sector` = '$sector', `image` = '$image', `width` = '$width', `height` = '$height', `background` = '$background', `updated` = '$date'  where  `id` =  '$id' ";
        $conn->exec($sql);

        $sql = "DELETE  FROM  `diagram_shape` where `diagram_id` = '$id' ";
        $conn->query($sql);

        // shapes
        foreach ($content->nodeDataArray as $item){
            $category = $item->category;
            $key = $item->key;
            $loc = $item->loc;
            $sql = "INSERT INTO `diagram_shape` (`diagram_id`, `category`, `key`, `loc` )  VALUES 
                   ('$id','$category','$key','$loc') ";
            $conn->exec($sql);
        }


        return $id;

    }



}