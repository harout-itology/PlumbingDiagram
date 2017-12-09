<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 10:24 AM
 */
include ('../loader.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $line = new Line();
    $input = $line->edit($conn, $_POST);
    if($input)
         $msg = 'Line Successfully Edited';
}
else{
    $line = new Line();
    $input = $line->view($conn, $_GET['id']);
}

$header='';

$body = '
<div class="container">
        <div class="row">
            <div class="col-md-12">';

            if(isset($msg))
                $body .= '<div class="alert alert-success">'.$msg.'</div>';

$body .= '    <form class="form-horizontal" method="post" action=""> 
                    <div class="form-group">
                        <label for="color" class="col-md-2 control-label">Color</label>
                        <div class="col-md-10">
                            <input id="color" type="text" class="form-control" name="color" placeholder="Color" value="'.$input['color'].'" required autofocus>
                        </div>
                    </div>                 
                    <div class="form-group">
                        <label for="size" class="col-md-2 control-label">Size</label>
                        <div class="col-md-10">
                            <input id="size" type="text" class="form-control" placeholder="Size" name="size" value="'.$input['size'].'" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-md-2 control-label">Type</label>
                        <div class="col-md-10">
                            <input id="type" type="text" class="form-control" placeholder="Type" name="type" value="'.$input['type'].'"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-md-2 control-label">Status</label>
                        <div class="col-md-10">
                            <input id="status" type="text" class="form-control" placeholder="Status" name="status" value="'.$input['status'].'"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-md-2 control-label">Notes</label>
                        <div class="col-md-10">
                            <input id="notes" type="text" class="form-control" placeholder="Notes" name="notes" value="'.$input['notes'].'"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                Edit
                            </button>
                            <input type="hidden" value="'.$input['id'].'" name="id"> 
                        </div>
                    </div>
                </form>
            </div>            
        </div>
</div>
';

$footer='';

include ('master.php');

?>


