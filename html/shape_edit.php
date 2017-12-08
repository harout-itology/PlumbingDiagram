<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 10:24 AM
 */
include ('../loader.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shape = new Shape();
    $input = $shape->edit($conn, $_POST);
    if($input)
         $msg = 'Shape Successfully Edited';
}
else{
    $shape = new Shape();
    $input = $shape->view($conn, $_GET['id']);
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
                        <label for="name" class="col-md-2 control-label">Note</label>
                        <div class="col-md-10">
                            <input id="name" type="text" class="form-control" name="note" placeholder="Shape Note" value="'.$input['note'].'" required autofocus>
                        </div>
                    </div>                 
                    <div class="form-group">
                        <label for="type" class="col-md-2 control-label">Type</label>
                        <div class="col-md-10">
                            <select id="type" class="form-control" name="type" required>
                                <option '; if($input['type']=='Rectangle') $body .= 'selected'; $body .= ' value="Rectangle">Rectangle</option>
                                <option '; if($input['type']=='Diamond')   $body .= 'selected'; $body .= ' value="Diamond">Diamond</option>
                                <option '; if($input['type']=='Triangle')  $body .= 'selected'; $body .= ' value="Triangle">Triangle</option>
                                <option '; if($input['type']=='Circle')    $body .= 'selected'; $body .= ' value="Circle">Circle</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="width" class="col-md-2 control-label">Width</label>
                        <div class="col-md-10">
                            <input id="width" type="text" class="form-control" placeholder="Integral" name="width" value="'.$input['width'].'" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="height" class="col-md-2 control-label">Height</label>
                        <div class="col-md-10">
                            <input id="height" type="text" class="form-control" placeholder="Integral" name="height" value="'.$input['height'].'" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="background" class="col-md-2 control-label">Background</label>
                        <div class="col-md-10">
                            <input id="background" type="text" class="form-control" placeholder="Background Color" name="background" value="'.$input['background'].'" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="col-md-2 control-label">Color</label>
                        <div class="col-md-10">
                            <input id="color" type="text" class="form-control" placeholder="Text Color" name="color" value="'.$input['color'].'" required >
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


