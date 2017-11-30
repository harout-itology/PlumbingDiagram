<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 10:24 AM
 */
include ('../loader.php');

if (isset($_GET['id'])) {
    $shape = new Shape();
    $input = $shape->delete($conn, $_GET['id']);
    if($input)
        $msg = 'Shape Successfully Deleted';
}

$shapes = new Shape();
$output = $shapes->get($conn);

$header='';

$body = '
<div class="container">
        <div class="row"><br><br>';


if(isset($msg))
    $body .= '<div class="alert alert-success">'.$msg.'</div>';

$body .= '<table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Background</th>
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
                                    <td>'.$item['id'].'</td>
                                    <td>'.$item['type'].'</td>
                                    <td>'.$item['background'].'</td>
                                    <td>'.$item['created'].'</td>
                                    <td>'.$item['updated'].'</td>                                    
                                    <td>
                                        <a href="/html/port_edit.php?id='.$item['id'].'" class="btn btn-default btn-sm">Edit Ports</a>                                                                              
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


