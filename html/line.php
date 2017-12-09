<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 10:24 AM
 */
include ('../loader.php');

if (isset($_GET['id'])) {
    $line = new Line();
    $input = $line->delete($conn, $_GET['id']);
    if($input)
        $msg = 'Line Successfully Deleted';
}

$lines = new Line();
$output = $lines->get($conn);

$header='';

$body = '
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/html/line_create.php" class="btn btn-primary pull-right btn-sm">Create New</a><br><br>
            </div>';

    if(isset($msg))
        $body .= '<div class="alert alert-success">'.$msg.'</div>';

    $body .= '<table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Type</th>
                                <th>Created</th>                                
                                <th>Updated</th>
                                <th>Options</th>
                            </tr>
                        </thead>
            <tbody>                        
            ';

            foreach ($output as $item){
                $body .= '            
                          <tr >
                                    <td>'.$item['color'].'</td>
                                    <td>'.$item['size'].'</td>
                                    <td>'.$item['type'].'</td>
                                    <td>'.$item['created'].'</td>
                                    <td>'.$item['updated'].'</td>                                    
                                    <td>
                                        <a href="/html/line_edit.php?id='.$item['id'].'" class="btn btn-default btn-sm">Edit</a>
                                        <a href="?id='.$item['id'].'" class="btn btn-default btn-sm">Delete</a>                                            
                                    </td>
                          </tr>
                ';

            }

$body .=  '</tbody>
          </table>

        </div>
</div>
';

$footer='';

include ('master.php');

?>


